<?php

namespace App\Http\Controllers\Admin\Roles;

use App\Http\Controllers\BaseComponent;
use App\Repositories\Interfaces\PermissionRepositoryInterface;
use App\Repositories\Interfaces\RoleRepositoryInterface;

class StoreRole extends BaseComponent
{
    public object $role ;
    public $permission , $name  , $header  , $permissionSelected = [];

    public function __construct($id = null)
    {
        parent::__construct($id);
        $this->roleRepository = app(RoleRepositoryInterface::class);
        $this->permissionRepository = app(PermissionRepositoryInterface::class);
    }

    public function mount($action , $id = null)
    {
        $this->authorizing('show_roles');
        $this->set_mode($action);
        if ($this->mode == self::UPDATE_MODE)
        {
            $this->role = $this->roleRepository->whereNotIn('name', ['administrator', 'admin'],$id);
            $this->header = $this->role->name;
            $this->name = $this->role->name;
            $this->permissionSelected = $this->role->permissions()->pluck('name')->toArray();
        } elseif ($this->mode == self::CREATE_MODE) $this->header = 'نقش جدید';
        else abort(404);
        $this->permission = $this->permissionRepository->getAll();
    }

    public function store()
    {
        $this->authorizing('edit_roles');
        if ($this->mode == self::UPDATE_MODE)
            $this->saveInDateBase($this->role);
        elseif ($this->mode == self::CREATE_MODE) {
            $this->saveInDateBase($this->roleRepository->newRoleObject());
            $this->reset(['name','permissionSelected']);
        }
    }

    public function saveInDateBase($model)
    {
        $this->validate(
            [
                'name' => ['required', 'string','max:250'],
                'permissionSelected' => ['required', 'array'],
                'permissionSelected.*' => ['required', 'exists:permissions,name'],
            ] , [] , [
                'name' => 'عنوان',
                'permissionSelected' => 'دسترسی ها',
                'permissionSelected.*' => 'دسترسی ها',
            ]
        );
        if (!in_array($this->role->name,['administrator', 'super_admin', 'admin','teacher'])) {
            $model->name = $this->name;
            $model = $this->roleRepository->save($model);
            $this->roleRepository->syncPermissions($model, $this->permissionSelected);
            $this->emitNotify('اطلاعات با موفقیت ثبت شد');
        } else {
            $this->emitNotify('برای نقش های ثابت سایت امکان تغییر نام وجود ندارد!','warning');
        }

    }

    public function deleteItem()
    {
        $this->authorizing('delete_roles');
        $role = $this->roleRepository->whereNotIn('name', ['administrator', 'super_admin', 'admin','teacher'] , $this->role->id);
        if (!is_null($role))
        {
            $this->roleRepository->delete($role);
            return redirect()->route('admin.role');
        } else
            return $this->emitNotify('امکان خذف برای این نقش وجود ندارد','warning');
    }

    public function render()
    {
        return view('admin.roles.store-role')
            ->extends('admin.layouts.admin');
    }
}
