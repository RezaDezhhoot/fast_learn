<?php

namespace App\Http\Controllers\Admin\StoragePermissions;

use App\Http\Controllers\BaseComponent;
use App\Repositories\Interfaces\StoragePermissionRepositoryInterface;
use App\Repositories\Interfaces\StorageRepositoryInterface;
use Livewire\WithPagination;

class IndexStoragePermission extends BaseComponent
{
    use WithPagination;

    public $storage , $placeholder = 'نام یا شماره همراه کاربر';
    protected $queryString = ['storage'];

    public function __construct($id = null)
    {
        parent::__construct($id);
        $this->storagePermissionRepository = app(StoragePermissionRepositoryInterface::class);
        $this->storageRepository = app(StorageRepositoryInterface::class);
    }

    public function mount()
    {
        $this->authorizing('show_storages');
        $this->data['storage'] = $this->storageRepository->getAll()->pluck('name','id');
    }

    public function delete($id)
    {
        $this->authorizing('delete_storages');
        $this->storagePermissionRepository->destroy($id);
    }

    public function render()
    {
        $acl = $this->storagePermissionRepository->getAllAdmin($this->search , $this->storage , $this->per_page);
        return view('admin.storage-permissions.index-storage-permission',['acl'=>$acl])->extends('admin.layouts.admin');
    }
}
