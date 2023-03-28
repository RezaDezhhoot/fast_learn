<?php

namespace App\Http\Controllers\Organ\Groups;

use App\Http\Controllers\BaseComponent;
use App\Repositories\Interfaces\CourseRepositoryInterface;
use App\Repositories\Interfaces\GroupRepositoryInterface;
use Illuminate\Support\Facades\Auth;
use Livewire\WithPagination;

class IndexGroup extends BaseComponent
{
    use WithPagination;

    protected $queryString = ['course'];

    public $course , $placeholder = 'عنوان گروه';

    public function __construct($id = null)
    {
        parent::__construct($id);
        $this->courseRepository = app(CourseRepositoryInterface::class);
        $this->groupRepository = app(GroupRepositoryInterface::class);
    }

    public function mount()
    {
        $this->data['course'] = Auth::user()->organCourses->pluck('title','id');
    }

    public function render()
    {
        $items = $this->groupRepository->getAllOrgan($this->search ,$this->course,$this->per_page);
        return view('organ.groups.index-group',get_defined_vars())->extends('organ.layouts.organ');
    }
}
