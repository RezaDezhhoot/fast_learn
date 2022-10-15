<?php

namespace App\Http\Controllers\Admin\StoragePermissions;

use App\Http\Controllers\BaseComponent;
use App\Repositories\Interfaces\StoragePermissionRepositoryInterface;
use App\Repositories\Interfaces\StorageRepositoryInterface;

class StoreStoragePermission extends BaseComponent
{
    public $user , $storage , $path = [] , $permission;
    public $header , $user_data;

    public function __construct($id = null)
    {
        parent::__construct($id);
        $this->storagePermissionRepository = app(StoragePermissionRepositoryInterface::class);
        $this->storageRepository = app(StorageRepositoryInterface::class);
    }

    public function mount($action , $id = null)
    {
        $this->authorizing('show_storages');
        $this->set_mode($action);

        if ($this->mode == self::UPDATE_MODE) {
            $this->permission = $this->storagePermissionRepository->findOrFail($id);
            $this->user = $this->permission->user_id;
            $this->storage = $this->permission->storage_id;
            $this->path = $this->permission->path;
            $this->user_data = $this->permission->user;
            $this->header = 'قوانین دیک '.$this->permission->storage->name;
        } else {
            $this->header = 'دسترسی جدید';
        }

        $this->data['storage'] = $this->storageRepository->getAll()->pluck('name','id');
        $this->data['access'] = [
            '0' => 'بسته',
            '1' => ' خواندن',
            '2' => 'خواندن و نوشتن'
        ];
    }

    public function store()
    {
        $this->authorizing('edit_storages');
        if ($this->mode == self::UPDATE_MODE) {
            $this->saveInDataBase($this->permission);
        } elseif ($this->mode == self::CREATE_MODE) {
            $this->saveInDataBase($this->storagePermissionRepository::getNewObject());
            $this->resetInput();
        }
    }

    private function saveInDataBase($model)
    {
        if (empty($this->path))
            $this->path = [];

        $this->validate([
            'user' => ['required','exists:users,id','integer'],
            'storage' => ['required','exists:storages,id','integer'],
            'path' => ['nullable','array','max:100000'],
            'path.*.path' => ['required','string','max:2500','min:1'],
            'path.*.access' => ['required','integer','in:0,1,2'],
        ],[],[
            'user' => 'کد کاربری',
            'storage' => 'دیسک',
            'path' => 'مسیر',
        ]);
        $model->user_id = $this->user;
        $model->storage_id = $this->storage;
        $model->path = $this->path;
        $model = $this->storagePermissionRepository->save($model);
        if ($this->mode == self::UPDATE_MODE && $model->wasChanged('user_id')) {
            redirect()->route('admin.store.acl',[self::UPDATE_MODE,$model->id]);
        }
        $this->emitNotify('اطلاعات با موفقیت ذخیره شد');
    }

    public function deleteItem()
    {
        $this->authorizing('delete_storages');
        $this->storagePermissionRepository->destroy($this->permission->id);
        redirect()->route('admin.acl');
    }

    public function resetInput()
    {
        $this->reset(['user','storage','path']);
    }

    public function addPath()
    {
        $this->path[] = [
            'path' => '', 'access' => '0'
        ];
    }

    public function deletePath($key)
    {
        unset($this->path[$key]);
    }

    public function render()
    {
        return view('admin.storage-permissions.store-storage-permission')->extends('admin.layouts.admin');
    }
}
