<?php

namespace App\Http\Controllers\Organ\Courses;

use App\Enums\CourseEnum;
use App\Http\Controllers\BaseComponent;
use App\Repositories\Interfaces\CourseRepositoryInterface;
use App\Repositories\Interfaces\NewCourseRepositoryInterface;
use Livewire\Component;
use Livewire\WithPagination;

class IndexCourses extends BaseComponent
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
            $this->courseRepository->getAllOrgan($this->search,$this->level ,$this->status,$this->per_page)
            : $this->newCoursesRepository->getAllOrgan($this->search,$this->new_status,$this->per_page);

        return view('organ.courses.index-courses',get_defined_vars())
            ->extends('organ.layouts.organ');
    }

    public function updatedTab()
    {
        $this->resetPage();
    }

    public function show_details($key)
    {
        $this->reset(['result']);
        $this->result = $this->newCoursesRepository->findOrFail($key)->result;
    }
}
