<?php

namespace App\Http\Controllers\Admin\ChapterTranscripts;

use App\Enums\ChapterEnum;
use App\Http\Controllers\BaseComponent;
use App\Repositories\Interfaces\ChapterTranscriptRepositoryInterface;
use App\Repositories\Interfaces\CourseRepositoryInterface;
use Livewire\WithPagination;

class IndexChapterTranscript extends BaseComponent
{
    use WithPagination;
    protected $queryString = ['course','status'];
    public $status;

    public ?string $course = null , $placeholder = 'عنوان فصل';

    public function __construct($id = null)
    {
        parent::__construct($id);
        $this->chapterTranscriptRepository = app(ChapterTranscriptRepositoryInterface::class);
        $this->courseRepository = app(CourseRepositoryInterface::class);
    }

    public function mount()
    {
        $this->data['status'] = ChapterEnum::getTranscriptStatus();
        $this->data['course'] = $this->courseRepository->getAll()->pluck('title','id')->toArray();
    }

    public function render()
    {
        $this->authorizing('show_chapters');
        $chapters = $this->chapterTranscriptRepository->getAllAdmin($this->course,$this->status,$this->search,$this->per_page);
        return view('admin.chapter-transcripts.index-chapter-transcript',['chapters'=>$chapters])
            ->extends('admin.layouts.admin');
    }
}
