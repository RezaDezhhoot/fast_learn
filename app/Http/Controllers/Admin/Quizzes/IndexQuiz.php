<?php

namespace App\Http\Controllers\Admin\Quizzes;

use App\Http\Controllers\BaseComponent;
use App\Repositories\Interfaces\QuizRepositoryInterface;
use Livewire\WithPagination;

class IndexQuiz extends BaseComponent
{
    use WithPagination;
    public string $placeholder = 'عنوان';

    public function __construct($id = null)
    {
        parent::__construct($id);
        $this->quizRepository = app(QuizRepositoryInterface::class);
    }

    public function render()
    {
        $this->authorizing('show_quizzes');
        $quizzes = $this->quizRepository->getAllAdmin($this->search , $this->per_page);
        return view('admin.quizzes.index-quiz',['quizzes' => $quizzes])->extends('admin.layouts.admin');
    }

    public function delete($id)
    {
        $this->authorizing('delete_quizzes');
        $this->quizRepository->destroy($id);
    }
}
