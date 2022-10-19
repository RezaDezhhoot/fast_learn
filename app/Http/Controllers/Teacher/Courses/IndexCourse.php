<?php

namespace App\Http\Controllers\Teacher\Courses;

use App\Enums\CourseEnum;
use App\Http\Controllers\BaseComponent;
use App\Repositories\Interfaces\CourseRepositoryInterface;
use App\Repositories\Interfaces\NewCourseRepositoryInterface;
use Livewire\WithPagination;

class IndexCourse extends BaseComponent
{
    use WithPagination;

    public ?string $placeholder = 'عنوان دوره';

    public $result;

    const COURSE = 'course' , NEW_COURSE = 'new_course';

    public $status , $level , $new_status , $tab;
    protected $queryString = ['status','level','new_status','tab'];

    public function __construct($id = null)
    {
        parent::__construct($id);
        $this->courseRepository = app(CourseRepositoryInterface::class);
        $this->newCoursesRepository = app(NewCourseRepositoryInterface::class);
    }

    public function mount()
    {
        if (!isset($this->tab))
            $this->tab = self::COURSE;

        $this->data['status'] = CourseEnum::getStatus();
        $this->data['level'] = CourseEnum::getLevels();
        $this->data['new_status'] = CourseEnum::getNewCourseStatus();
        $this->data['tab'] = [
            self::COURSE => [
                'title' => 'دوره های فعال',
                'icon' => 'fab fa-product-hunt'
            ],
            self::NEW_COURSE => [
                'title' => 'دوره های جدید',
                'icon' => 'fas fa-circle-notch'
            ],
        ];
    }

    public function render()
    {
        $courses = $this->tab == self::COURSE ?
            $this->courseRepository->getAllTeacher($this->search,$this->level ,$this->status,$this->per_page)
            : $this->newCoursesRepository->getAllTeacher($this->search,$this->new_status,$this->per_page);

        return view('teacher.courses.index-course',['courses'=>$courses])->extends('teacher.layouts.teacher');
    }

    public function updatedTab()
    {
        $this->resetPage();
    }

    public function show_details($key)
    {
        $this->reset(['result']);
        $this->result = auth()->user()->newCourses->filter(function ($v,$k) use ($key){
            return $v['id'] == $key;
        })->first()->result;
    }
}
