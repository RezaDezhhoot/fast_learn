<?php

namespace App\Http\Controllers\Admin\Questions;

use App\Enums\CategoryEnum;
use App\Http\Controllers\BaseComponent;
use App\Repositories\Interfaces\CategoryRepositoryInterface;
use App\Repositories\Interfaces\QuestionRepositoryInterface;
use Livewire\WithPagination;

class IndexQuestion extends BaseComponent
{
    use WithPagination;
    protected $queryString = ['category'];
    public ?string $category = null , $placeholder = 'نام سوال';

    public function __construct($id = null)
    {
        parent::__construct($id);
        $this->categoryRepository = app(CategoryRepositoryInterface::class);
        $this->questionRepository = app(QuestionRepositoryInterface::class);
    }

    public function mount()
    {
        $this->data['categories'] =  $this->categoryRepository->getAll(CategoryEnum::QUESTION)->pluck('title','id');
    }

    public function render()
    {
        $this->authorizing('show_questions');
        $questions = $this->questionRepository->getAllAdmin($this->search,$this->category,$this->per_page);
        return view('admin.questions.index-question',['questions' => $questions])
            ->extends('admin.layouts.admin');
    }

    public function delete($id)
    {
        $this->authorizing('delete_questions');
        $question = $this->questionRepository->find($id);
        $this->questionRepository->delete($question);
    }
}
