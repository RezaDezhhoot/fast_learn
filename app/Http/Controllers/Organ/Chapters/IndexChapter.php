<?php

namespace App\Http\Controllers\Organ\Chapters;

use App\Enums\ChapterEnum;
use App\Http\Controllers\BaseComponent;
use App\Repositories\Interfaces\ChapterRepositoryInterface;
use App\Repositories\Interfaces\ChapterTranscriptRepositoryInterface;
use Illuminate\Support\Facades\Auth;
use Livewire\WithPagination;

class IndexChapter extends BaseComponent
{
    use WithPagination;

    protected $queryString = ['course' , 'status' , 'tab'];

    public $course , $status  , $tab , $placeholder = 'عنوان درس' , $result;

    const CHAPTERS = 'chapters' , TRANSCRIPTS = 'transcripts';

    public function __construct($id = null)
    {
        parent::__construct($id);
        $this->chapterTranscriptRepository = app(ChapterTranscriptRepositoryInterface::class);
        $this->chapterRepository = app(ChapterRepositoryInterface::class);
    }

    public function mount()
    {
        if (!isset($this->tab))
            $this->tab = self::CHAPTERS;

        $this->data['status'] = ChapterEnum::getTranscriptStatus();
        $this->data['course'] = Auth::user()->organCourses->pluck('title','id');
        $this->data['tab'] = [
            self::CHAPTERS => ['title'=>'فصل ها','icon' => 'flaticon2-open-text-book'],
            self::TRANSCRIPTS => ['title'=>'رو نوشت ها','icon' => 'fas fa-envelope-open-text']
        ];
    }

    public function render()
    {
        $chapters = $this->tab == self::CHAPTERS ?
            $this->chapterRepository->getAllOrgan($this->search,$this->course,$this->status,$this->per_page) :
            $this->chapterTranscriptRepository->getAllOrgan($this->course,$this->status,$this->search,$this->per_page);
        return view('organ.chapters.index-chapter',get_defined_vars())
            ->extends('organ.layouts.organ');
    }

    public function updatedTab()
    {
        $this->resetPage();
    }

    public function show_details($key)
    {
        $this->reset(['result']);
        $this->result = $this->chapterTranscriptRepository->findOrganChapter($key)->message;
    }
}
