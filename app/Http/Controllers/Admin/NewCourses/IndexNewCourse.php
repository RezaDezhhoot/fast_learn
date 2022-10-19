<?php

namespace App\Http\Controllers\Admin\NewCourses;

use App\Enums\CourseEnum;
use App\Http\Controllers\BaseComponent;
use App\Repositories\Interfaces\NewCourseRepositoryInterface;
use Livewire\WithPagination;

class IndexNewCourse extends BaseComponent
{
    use WithPagination;

    public $status , $placeholder = 'عنوان دوره';

    protected $queryString = ['status'];

    public function __construct($id = null)
    {
        parent::__construct($id);
        $this->newCoursesRepository = app(NewCourseRepositoryInterface::class);
    }

    public function mount()
    {
        $this->authorizing('show_new_courses');
        $this->data['status'] = CourseEnum::getNewCourseStatus();
    }

    public function delete($id)
    {
        $this->authorizing('delete_new_courses');
        $this->newCoursesRepository->destroy($id);
    }

    public function render()
    {
        $courses = $this->newCoursesRepository->getAllAdmin($this->search , $this->status , $this->per_page);
        return view('admin.new-courses.index-new-course',['courses'=>$courses])->extends('admin.layouts.admin');
    }
}
