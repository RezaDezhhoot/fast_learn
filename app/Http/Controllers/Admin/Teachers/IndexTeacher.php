<?php

namespace App\Http\Controllers\Admin\Teachers;

use App\Http\Controllers\BaseComponent;
use App\Repositories\Interfaces\TeacherRepositoryInterface;
use Livewire\WithPagination;

class IndexTeacher extends BaseComponent
{
    use WithPagination;
    public ?string $placeholder = 'نام یا شماره همراه مدرس';

    public function __construct($id = null)
    {
        parent::__construct($id);
        $this->teacherRepository = app(TeacherRepositoryInterface::class);
    }

    public function render()
    {
        $this->authorizing('show_teachers');
        $teachers = $this->teacherRepository->getAllAdmin($this->search,$this->per_page);
        return view('admin.teachers.index-teacher',['teachers'=> $teachers])
            ->extends('admin.layouts.admin');
    }
}
