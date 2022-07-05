<?php

namespace App\Http\Controllers\Admin\Comments;

use App\Enums\CommentEnum;
use App\Http\Controllers\BaseComponent;
use App\Repositories\Interfaces\CommentRepositoryInterface;
use Livewire\WithPagination;

class IndexComment extends BaseComponent
{
    use WithPagination;
    protected $queryString = ['for','status'];
    public ?string $status = null , $for = null , $placeholder = 'نام یا شماره کاربر';

    public function __construct($id = null)
    {
        parent::__construct($id);
        $this->commentRepository = app(CommentRepositoryInterface::class);
    }

    public function mount()
    {
        foreach (CommentEnum::getStatus() as $key => $value)
            $this->data['status'][$key] = $value.' ('.$this->commentRepository->getByConditionCount('status','=',$key).')';

        $this->data['for'] = CommentEnum::getFor();
    }

    public function render()
    {
        $this->authorizing('show_comments');
        $comments = $this->commentRepository->getAllAdminList($this->search,$this->status,$this->for,$this->per_page,false);

        return view('admin.comments.index-comment',['comments'=>$comments])
            ->extends('admin.layouts.admin');
    }

    public function delete($id)
    {
        $this->authorizing('delete_comments');
        $comment = $this->commentRepository->find($id,false);
        $this->commentRepository->delete($comment);
    }

    public function confirm($id)
    {
        $this->authorizing('edit_comments');
        $comment = $this->commentRepository->find($id,false);
        $comment->status = CommentEnum::CONFIRMED;
        $this->commentRepository->save($comment);
        $this->emitNotify('اطلاعات با موفقیت ثبت شد');
    }
}
