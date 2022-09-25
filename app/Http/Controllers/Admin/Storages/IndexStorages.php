<?php

namespace App\Http\Controllers\Admin\Storages;

use App\Enums\StorageEnum;
use App\Http\Controllers\BaseComponent;
use App\Repositories\Interfaces\StorageRepositoryInterface;
use Livewire\WithPagination;

class IndexStorages extends BaseComponent
{
    use WithPagination;

    protected $queryString = ['status'];

    public $status , $placeholder = 'عنوان';

    public function __construct($id = null)
    {
        parent::__construct($id);
        $this->storageRepository = app(StorageRepositoryInterface::class);
    }

    public function mount()
    {
        $this->authorizing('show_storages');
        $this->data['status'] = StorageEnum::getStatus();
    }

    public function render()
    {
        $storages = $this->storageRepository->getAllAdmin($this->search , $this->status , $this->per_page);
        return view('admin.storages.index-storages',['storages'=>$storages])->extends('admin.layouts.admin');
    }

    public function delete($id)
    {
        $this->authorizing('delete_storages');
        $this->storageRepository->destroy($id);
    }
}
