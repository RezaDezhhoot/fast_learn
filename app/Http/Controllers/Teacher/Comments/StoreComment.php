<?php

namespace App\Http\Controllers\Teacher\Comments;

use App\Enums\CommentEnum;
use App\Enums\LastActivitiesEnum;
use App\Http\Controllers\BaseComponent;
use App\Repositories\Interfaces\CommentRepositoryInterface;
use App\Repositories\Interfaces\LastActivityRepositoryInterface;
use Illuminate\Support\Facades\Auth;

class StoreComment extends BaseComponent
{
    public $comment   , $header , $content , $score , $status , $type , $case , $child = [] , $answer;

    public function __construct($id = null)
    {
        parent::__construct($id);
        $this->commentRepository = app(CommentRepositoryInterface::class);
        $this->lastActivityRepository = app(LastActivityRepositoryInterface::class);
    }

    public function mount($action , $id)
    {
        self::set_mode($action);
        if ($this->mode == self::UPDATE_MODE) {
            $this->comment = $this->commentRepository->findTeacher($id);
            $this->header = $this->comment->user->name;
            $this->child = $this->comment->childrenRecursive;
            $this->case = $this->comment->commentable_data['title'] ?? '';
        } else abort(404);
    }

    public function newAnswer()
    {
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

            $this->lastActivityRepository->register_activity([
                'user_id' => Auth::id(),
                'subject' => LastActivitiesEnum::appendTitle(LastActivitiesEnum::COMMENTS,'new',''),
                'url' => route('teacher.store.comments',['edit',$this->comment->id]),
                'icon' => LastActivitiesEnum::COMMENTS['icon']
            ]);

            $this->emitNotify('اطلاعات با موفقیت ثبت شد');

            $this->reset(['answer']);
            $this->child->push($comment);
        }
    }

    public function render()
    {
        return view('teacher.comments.store-comment')->extends('teacher.layouts.teacher');
    }
}
