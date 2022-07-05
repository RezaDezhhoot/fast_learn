<?php

namespace App\Http\Controllers\Admin\Teachers;

use App\Http\Controllers\BaseComponent;
use App\Repositories\Interfaces\TeacherRepositoryInterface;
use App\Repositories\Interfaces\UserRepositoryInterface;

class StoreTeacher extends BaseComponent
{
    public object $teacher;
    public ?string $body = null , $header = null;
    public $user , $user_id , $sub_title , $userRole;

    public $users = [];

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
            $this->user_id = $this->teacher->user_id;
            $this->user = $this->teacher->user->name;
            $this->header = $this->teacher->name;
            $this->sub_title = $this->teacher->sub_title;
            $this->userRole = $this->teacher->user->roles()->pluck('name','id')->toArray();
        } elseif ($this->mode == self::CREATE_MODE) {
            $this->header = 'مدرس جدید';
        } else abort(404);
        $this->data['users'] = $this->userRepository->getAll()->pluck('phone','id');
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
            'user_id' => ['required','exists:users,id','unique:teachers,user_id,'.($this->teacher->id ?? 0)],
        ],[],[
            'sub_title' => 'عنوان',
            'body' => 'متن',
            'user_id' => 'مدرس',
        ]);
        $model->sub_title  = $this->sub_title;
        $model->body  = $this->body;
        $model->user_id  = $this->user_id;
        $model = $this->teacherRepository->save($model);
        return $this->emitNotify('اطلاعات با موفقیت ثبت شد');
    }

    public function deleteItem()
    {
        $this->authorizing('delete_teachers');
        $this->teacherRepository->destroy($this->teacher->id);
        return redirect()->route('admin.teacher');
    }

    public function searchUser()
    {
        $this->users = $this->userRepository->searchUsers(['name','id'],[['phone','like',"%{$this->user}%"]],
            [['email','like',"%{$this->user}%"]])->toArray();
    }

    public function setUser($id , $name)
    {
        $this->user_id = $id;
        $this->user = $name;
        $this->userRole = $this->userRepository->find($id)->roles()->pluck('name','id')->toArray();
    }

    public function render()
    {
        return view('admin.teachers.store-teacher')->extends('admin.layouts.admin');
    }
}
