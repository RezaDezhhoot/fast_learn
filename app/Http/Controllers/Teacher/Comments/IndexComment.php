<?php

namespace App\Http\Controllers\Teacher\Comments;

use App\Enums\CommentEnum;
use App\Http\Controllers\BaseComponent;
use App\Repositories\Interfaces\CommentRepositoryInterface;

class IndexComment extends BaseComponent
{
    public $status , $placeholder = 'شماره همراه یا نام کاربر';

    protected $queryString = ['status'];

    public function __construct($id = null)
    {
        parent::__construct($id);
        $this->commentRepository = app(CommentRepositoryInterface::class);
    }

    public function mount()
    {
        $this->data['status'] = CommentEnum::getStatus();
    }

    public function render()
    {
        $comments = $this->commentRepository->getAllTeacher($this->search , $this->status,$this->per_page);
        return view('teacher.comments.index-comment',['comments'=>$comments])->extends('teacher.layouts.teacher');
    }
}
