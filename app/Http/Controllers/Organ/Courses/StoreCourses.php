<?php

namespace App\Http\Controllers\Organ\Courses;

use App\Enums\CourseEnum;
use App\Enums\StorageEnum;
use App\Http\Controllers\BaseComponent;
use App\Repositories\Interfaces\LastActivityRepositoryInterface;
use App\Repositories\Interfaces\NewCourseRepositoryInterface;
use App\Traits\ChatPanel;
use Livewire\WithFileUploads;

class StoreCourses extends BaseComponent
{
    use WithFileUploads , ChatPanel;
    public $title , $descriptions , $level  ,$files = [] , $header , $course , $component = 'teacher';

    public function __construct($id = null)
    {
        parent::__construct($id);
        $this->newCoursesRepository = app(NewCourseRepositoryInterface::class);
        $this->lastActivityRepository = app(LastActivityRepositoryInterface::class);
    }

    public function mount($action = null , $id = null)
    {
        self::set_mode($action);
       if ($this->mode == self::UPDATE_MODE) {
            $this->course = $this->newCoursesRepository->findOrFail($id);
            $this->header = $this->course->title;
        } else {
            abort(404);
        }

    }
    public function render()
    {
        return view('organ.courses.store-courses')
            ->extends('organ.layouts.organ');
    }
}
