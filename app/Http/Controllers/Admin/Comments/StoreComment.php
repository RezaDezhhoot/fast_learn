<?php

namespace App\Http\Controllers\Admin\Comments;

use App\Enums\CommentEnum;
use App\Http\Controllers\BaseComponent;
use App\Repositories\Interfaces\CommentRepositoryInterface;

class StoreComment extends BaseComponent
{
    public $comment   , $header , $content , $score , $status , $type , $case , $child = [] , $answer;

    public function __construct($id = null)
    {
        parent::__construct($id);
        $this->commentRepository = app(CommentRepositoryInterface::class);
    }

    public function mount($action , $id = null)
    {
        $this->authorizing('show_comments');
        $this->set_mode($action);
        if ($this->mode == self::UPDATE_MODE)
        {
            $this->comment = $this->commentRepository->find($id,false);
            $this->header = $this->comment->user->name;
            $this->status = $this->comment->status;
            $this->content = $this->comment->content;
            $this->child = $this->comment->childrenRecursive;
            $this->case = $this->comment->commentable_data['title'] ?? '-';
        } else abort(404);

        $this->data['type'] = CommentEnum::getFor();
        $this->data['status'] = CommentEnum::getStatus();
    }

    public function store()
    {
        $this->authorizing('edit_comments');
        $this->validate([
            'status' => ['required','in:'.implode(',',array_keys(CommentEnum::getStatus()))],
            'content' => ['required','string','max:250'],
        ],[],[
            'status' => 'وضعیت',
            'content' => 'متن',
        ]);

        $this->comment->status = $this->status;
        $this->comment->content = $this->content;
        $this->commentRepository->save($this->comment);
        $this->emitNotify('اطلاعات با موفقیت ثبت شد');
    }

    public function newAnswer()
    {
        $this->authorizing('edit_comments');
        if (is_null($this->comment->parent_id)) {
            $this->validate([
                'answer' => ['required','string','max:250'],
            ],[],[
                'answer' => 'متن',
            ]);
            $comment = [
                'user_id' => auth()->id(),
                'status' => CommentEnum::CONFIRMED,
                'content'=> $this->answer,
                'commentable_type' => $this->comment->commentable_type,
                'commentable_id' => $this->comment->commentable_id,
                'parent_id' => $this->comment->id
            ];
            $comment = $this->commentRepository->create($comment);
            $this->emitNotify('اطلاعات با موفقیت ثبت شد');
            $this->reset(['answer']);
            $this->child->push($comment);
        }
    }

    public function deleteItem()
    {
        $this->authorizing('delete_comments');
        $this->commentRepository->delete($this->comment);
        return redirect()->route('admin.comment');
    }

    public function render()
    {
        return view('admin.comments.store-comment')
            ->extends('admin.layouts.admin');
    }
}
