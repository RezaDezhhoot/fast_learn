<?php

namespace App\Http\Controllers\Admin\RollCalls;

use App\Enums\CategoryEnum;
use App\Enums\CourseEnum;
use App\Http\Controllers\BaseComponent;
use App\Repositories\Interfaces\CategoryRepositoryInterface;
use App\Repositories\Interfaces\CourseRepositoryInterface;
use Livewire\WithPagination;

class IndexRollCall extends BaseComponent
{
    use WithPagination;
    protected $queryString = ['status','category','type'];
    public ?string $status = null , $type = null , $category = null , $placeholder = 'عنوان یا نام مستعار';

    public function __construct($id = null)
    {
        parent::__construct($id);
        $this->categoryRepository = app(CategoryRepositoryInterface::class);
        $this->courseRepository = app(CourseRepositoryInterface::class);
    }

    public function mount()
    {
        $this->data['status'] = CourseEnum::getStatus();
        $this->data['type'] = CourseEnum::getTypes();
        $this->data['category'] = $this->categoryRepository->getAll(CategoryEnum::COURSE)->pluck('title','id');
    }


    public function render()
    {
        $this->authorizing('show_roll_calls');
        $courses =  $this->courseRepository->getAllAdmin(
            $this->search , $this->status , $this->category, $this->per_page , $this->type
        );
        return view('admin.roll-calls.index-roll-call',['courses' => $courses])
            ->extends('admin.layouts.admin');
    }
}
