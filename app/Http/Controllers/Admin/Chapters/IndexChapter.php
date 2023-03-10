<?php

namespace App\Http\Controllers\Admin\Chapters;

use App\Enums\ChapterEnum;
use App\Http\Controllers\BaseComponent;
use App\Repositories\Interfaces\ChapterRepositoryInterface;
use App\Repositories\Interfaces\CourseRepositoryInterface;
use Livewire\Component;
use Livewire\WithPagination;

class IndexChapter extends BaseComponent
{
    use WithPagination;
    protected $queryString = ['status','course'];
    public $status , $course , $placeholder = 'عنوان فصل';

    public function __construct($id = null)
    {
        parent::__construct($id);
        $this->chapterRepository = app(ChapterRepositoryInterface::class);
        $this->courseRepository = app(CourseRepositoryInterface::class);
    }

    public function mount()
    {
        $this->data['status'] = ChapterEnum::getStatus();
        $this->data['course'] = $this->courseRepository->getAll()->pluck('title','id');
    }

    public function render()
    {
        $this->authorizing('show_chapters');
        $items = $this->chapterRepository->getAllAdmin($this->search,$this->course,$this->status,$this->per_page);
        return view('admin.chapters.index-chapter',['items'=>$items])
            ->extends('admin.layouts.admin');
    }
}
