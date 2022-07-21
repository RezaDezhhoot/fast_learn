<?php

namespace App\Http\Controllers\Admin\Contacts;

use App\Enums\ContactUsEnum;
use App\Http\Controllers\BaseComponent;
use App\Repositories\Interfaces\ContactUsRepositoryInterface;
use Livewire\WithPagination;

class IndexContactUs extends BaseComponent
{
    use WithPagination;

    public $status , $placeholder = 'شماره یا ایمیل یا نام کاربر';

    protected $queryString = ['status'];

    public function __construct($id = null)
    {
        parent::__construct($id);
        $this->contactUsRepository = app(ContactUsRepositoryInterface::class);
    }

    public function mount()
    {
        $this->data['status'] = ContactUsEnum::getStatus();
    }

    public function render()
    {
        $this->authorizing('show_contacts');
        $contacts = $this->contactUsRepository->getAllAdmin($this->search,$this->status,$this->per_page);
        return view('admin.contacts.index-contact-us',['contacts'=>$contacts])->extends('admin.layouts.admin');
    }

    public function delete($id)
    {
        $this->authorizing('delete_contacts');
        $this->contactUsRepository->destroy($id);
    }
}
