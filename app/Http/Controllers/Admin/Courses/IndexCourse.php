<?php

namespace App\Http\Controllers\Admin\Courses;

use App\Enums\CategoryEnum;
use App\Enums\CourseEnum;
use App\Http\Controllers\BaseComponent;
use App\Repositories\Interfaces\CategoryRepositoryInterface;
use App\Repositories\Interfaces\CourseRepositoryInterface;
use App\Repositories\Interfaces\ExecutiveRepositoryInterface;
use App\Repositories\Interfaces\OrganizationRepositoryInterface;
use Livewire\WithPagination;

class IndexCourse extends BaseComponent
{
    use WithPagination;
    protected $queryString = ['status','category','type' ,'organization' ,'executive'];
    public $executive , $organization;
    public ?string $status = null , $type = null , $category = null , $placeholder = 'عنوان یا نام مستعار';

    public function __construct($id = null)
    {
        parent::__construct($id);
        $this->categoryRepository = app(CategoryRepositoryInterface::class);
        $this->courseRepository = app(CourseRepositoryInterface::class);
        $this->organizationRepository = app(OrganizationRepositoryInterface::class);
        $this->executiveRepository = app(ExecutiveRepositoryInterface::class);
    }

    public function mount()
    {
        $this->data['status'] = CourseEnum::getStatus();
        $this->data['type'] = CourseEnum::getTypes();
        
        $this->data['category'] = $this->categoryRepository->getAll(CategoryEnum::COURSE)->pluck('title','id');
    }

    public function render()
    {
        $this->authorizing('show_courses');
        $this->data['organs'] = $this->organizationRepository->get(parent:true);
        $this->data['executives'] = $this->executiveRepository->get(parent:true);
       

        $courses =  $this->courseRepository->getAllAdmin(
            $this->search , $this->status , $this->category, $this->per_page , $this->type , $this->organization , $this->executive
        );
        return view('admin.courses.index-course',['courses' => $courses])
            ->extends('admin.layouts.admin');
    }
}
