<?php

namespace App\Http\Controllers\Admin\Comments;

use App\Enums\CommentEnum;
use App\Http\Controllers\BaseComponent;
use App\Repositories\Interfaces\ArticleRepositoryInterface;
use App\Repositories\Interfaces\CommentRepositoryInterface;
use App\Repositories\Interfaces\CourseRepositoryInterface;
use Livewire\WithPagination;

class IndexComment extends BaseComponent
{
    use WithPagination;
    protected $queryString = ['for','status','case'];
    public  $status = null , $case , $for = null , $placeholder = 'نام یا شماره کاربر';

    public function __construct($id = null)
    {
        parent::__construct($id);
        $this->commentRepository = app(CommentRepositoryInterface::class);
        $this->articleRepository = app(ArticleRepositoryInterface::class);
        $this->courseRepository = app(CourseRepositoryInterface::class);
    }

    public function mount()
    {
        foreach (CommentEnum::getStatus() as $key => $value)
            $this->data['status'][$key] = $value.' ('.$this->commentRepository->getByConditionCount('status','=',$key,false).')';

        $this->data['for'] = CommentEnum::getFor();
    }

    public function render()
    {
        $this->authorizing('show_comments');
        $comments = $this->commentRepository->getAllAdminList($this->search,$this->status,$this->for,$this->per_page,$this->case,false);

        if ($this->for == CommentEnum::ARTICLE)
            $this->data['case'] = $this->articleRepository->getAll()->pluck('title','id');
        elseif ($this->for == CommentEnum::COURSE)
            $this->data['case'] = $this->courseRepository->getAll()->pluck('title','id');
        else {
            $this->data['case'] = [];
            $this->reset(['case']);
        }

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
