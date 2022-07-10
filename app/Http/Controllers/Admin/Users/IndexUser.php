<?php

namespace App\Http\Controllers\Admin\Users;

use App\Enums\UserEnum;
use App\Http\Controllers\BaseComponent;
use App\Repositories\Interfaces\RoleRepositoryInterface;
use App\Repositories\Interfaces\UserRepositoryInterface;
use Livewire\WithPagination;

class IndexUser extends BaseComponent
{
    use WithPagination  ;
    public $roles  , $status , $placeholder = 'نام کاربری یا شماره همراه';
    protected $queryString = ['status','roles'];

    public function __construct($id = null)
    {
        parent::__construct($id);
        $this->roleRepository = app(RoleRepositoryInterface::class);
        $this->userRepository = app(UserRepositoryInterface::class);
    }

    public function render()
    {
        $this->data['status'] = UserEnum::getStatus();
        $this->data['roles'] = $this->roleRepository->whereNotIn('name', ['administrator'])->pluck('name','name');
        $users = $this->userRepository->getAllAdminList($this->status,$this->roles ,$this->search,$this->per_page);
        return view('admin.users.index-user',['users' => $users])->extends('admin.layouts.admin');
    }

    public function confirm($id)
    {
        $this->authorizing('edit_users');
        $user = $this->userRepository->find($id);
        if ($user->status <> UserEnum::NOT_CONFIRMED) {
            $user->status = UserEnum::CONFIRMED;
            $this->userRepository->save($user);
            $this->emitNotify('اطلاعات با موفقیت ثبت شد');
        }
    }
}
