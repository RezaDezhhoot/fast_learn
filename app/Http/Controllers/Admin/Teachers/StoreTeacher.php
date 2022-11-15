<?php

namespace App\Http\Controllers\Admin\Teachers;

use App\Http\Controllers\BaseComponent;
use App\Repositories\Interfaces\TeacherRepositoryInterface;
use App\Repositories\Interfaces\UserRepositoryInterface;

class StoreTeacher extends BaseComponent
{
    public object $teacher;
    public ?string $body = null , $header = null;
    public $user , $user_id , $sub_title , $panel_status = true ;

    public function __construct($id = null)
    {
        parent::__construct($id);
        $this->teacherRepository = app(TeacherRepositoryInterface::class);
        $this->userRepository = app(UserRepositoryInterface::class);
    }

    public function mount($action , $id = null)
    {
        $this->set_mode($action);
        if ($this->mode == self::UPDATE_MODE) {
            $this->teacher = $this->teacherRepository->find($id);
            $this->body = $this->teacher->body;
            $this->header = $this->teacher->user->name;
            $this->sub_title = $this->teacher->sub_title;
            $this->panel_status = $this->teacher->panel_status ?? false;
        } else abort(404);
    }

    public function store()
    {
        if ($this->mode == self::UPDATE_MODE) {
            $this->saveInDataBase($this->teacher);
        } elseif ($this->mode == self::CREATE_MODE) {
            $this->saveInDataBase($this->teacherRepository->newTeacherObject());
            $this->reset(['user','body','sub_title']);
        }
    }

    public function saveInDataBase($model)
    {
        $this->validate([
            'sub_title' => ['required','max:70'],
            'body' => ['required','string','max:12500'],
            'panel_status' => ['required','boolean']
        ],[],[
            'sub_title' => 'عنوان',
            'body' => 'متن',
            'panel_status' => 'دسترسی به پنل'
        ]);
        $model->sub_title  = $this->sub_title;
        $model->body  = $this->body;
        $model->panel_status  = $this->panel_status;
        $model = $this->teacherRepository->save($model);
        return $this->emitNotify('اطلاعات با موفقیت ثبت شد');
    }

    public function render()
    {
        return view('admin.teachers.store-teacher')->extends('admin.layouts.admin');
    }
}
