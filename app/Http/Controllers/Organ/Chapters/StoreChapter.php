<?php

namespace App\Http\Controllers\Organ\Chapters;

use App\Enums\ChapterEnum;
use App\Http\Controllers\BaseComponent;
use App\Repositories\Interfaces\ChapterRepositoryInterface;
use App\Repositories\Interfaces\ChapterTranscriptRepositoryInterface;
use App\Repositories\Interfaces\CourseRepositoryInterface;
use App\Repositories\Interfaces\SettingRepositoryInterface;
use App\Rules\OrganCourses;
use Illuminate\Support\Facades\Auth;

class StoreChapter extends BaseComponent
{
    public $header , $chapter , $title , $view , $description , $course ;

    public function __construct($id = null)
    {
        parent::__construct($id);
        $this->courseRepository = app(CourseRepositoryInterface::class);
        $this->settingRepository = app(SettingRepositoryInterface::class);
        $this->chapterRepository = app(ChapterRepositoryInterface::class);
        $this->chapterTranscriptRepository = app(ChapterTranscriptRepositoryInterface::class);
    }

    public function mount($action , $id = null)
    {
        $this->set_mode($action);
        $this->data['course'] = Auth::user()->organCourses->pluck('title','id');
        if ($this->mode == self::UPDATE_MODE) {
            $this->chapter = $this->chapterRepository->findOrFailOrgan($id);
            $this->title = $this->chapter->title;
            $this->view = $this->chapter->view;
            $this->description = $this->chapter->description;
            $this->course = $this->chapter->course_id;
            $this->header = " {$this->chapter->course->title} - {$this->chapter->title}";
        } elseif ($this->mode == self::CREATE_MODE) {
            $this->header = 'فصل جدید';
        } else abort(404);
    }

    public function store()
    {
        if ($this->mode == self::UPDATE_MODE) {
            if (is_null($this->chapter->transcripts) || $this->chapter->transcripts->where('status',ChapterEnum::TRANSCRIPT_PENDING)->count() == 0) {
                $this->saveInDataBase($this->chapterTranscriptRepository->getNewObject());
                redirect()->route('organ.chapters');
            } else
                $this->emitNotify('برای این فصل رونوشت در حال بررسی وجود دارد','warning');
        }
        elseif ($this->mode == self::CREATE_MODE){
            $this->saveInDataBase($this->chapterTranscriptRepository->getNewObject());
            redirect()->route('organ.chapters');
        }
    }

    public function render()
    {
        return view('organ.chapters.store-chapter')->extends('organ.layouts.organ');
    }

    private function saveInDataBase($chapter)
    {
        $this->validate([
            'title' => ['required','string','max:255'],
            'description' => ['required','string','max:1400'],
            'course' => ['required','exists:courses,id',new OrganCourses()],
            'view' => ['required','integer'],
        ],[],[
            'title' => ' عنوان درس',
            'description' => 'توضیحات',
            'view' => 'نمایش درس',
            'course' => 'دوره اموزشی',
        ]);
        $chapter->status = ChapterEnum::TRANSCRIPT_PENDING;
        $chapter->title = $this->title;
        $chapter->description = $this->description;
        $chapter->course_id = $this->course;
        $chapter->view = $this->view;
        $chapter->chapter_id = $this->mode == self::UPDATE_MODE ? $this->chapter->id : null;
        $chapter = $this->chapterTranscriptRepository->save($chapter);
    }

}
