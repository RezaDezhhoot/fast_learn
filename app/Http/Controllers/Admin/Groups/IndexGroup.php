<?php

namespace App\Http\Controllers\Admin\Groups;

use App\Http\Controllers\BaseComponent;
use App\Repositories\Interfaces\CourseRepositoryInterface;
use App\Repositories\Interfaces\GroupRepositoryInterface;
use Livewire\Component;
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
        $this->authorizing('show_groups');
        $this->data['course'] = $this->courseRepository->getAll()->pluck('title','id');
    }

    public function render()
    {
        $items = $this->groupRepository->getAllAdmin($this->search ,$this->course,$this->per_page);
        return view('admin.groups.index-group',get_defined_vars())->extends('admin.layouts.admin');
    }

    public function delete($id)
    {
        $this->authorizing('delete_groups');
        $this->groupRepository->destroy($id);
    }
}
