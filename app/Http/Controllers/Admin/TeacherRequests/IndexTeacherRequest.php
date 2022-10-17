<?php

namespace App\Http\Controllers\Admin\TeacherRequests;

use App\Enums\TeacherEnum;
use App\Http\Controllers\BaseComponent;
use App\Repositories\Interfaces\TeacherRequestRepositoryInterface;
use Livewire\WithPagination;

class IndexTeacherRequest extends BaseComponent
{
    use WithPagination;

    protected $queryString = ['status'];

    public ?string $status = null , $placeholder = 'شماره همراه';

    public function __construct($id = null)
    {
        parent::__construct($id);
        $this->teacherRequestRepository = app(TeacherRequestRepositoryInterface::class);
    }

    public function mount()
    {
        $this->data['status'] = TeacherEnum::getStatus();
    }

    public function render()
    {
        $this->authorizing('show_teacher_requests');
        $requests = $this->teacherRequestRepository->getAllAdmin($this->search , $this->status,$this->per_page);
        return view('admin.teacher-requests.index-teacher-request',['requests'=>$requests])->extends('admin.layouts.admin');
    }

    public function delete($id)
    {
        $this->authorizing('delete_teacher_requests');
        $this->teacherRequestRepository->destroy($id);
    }
}
