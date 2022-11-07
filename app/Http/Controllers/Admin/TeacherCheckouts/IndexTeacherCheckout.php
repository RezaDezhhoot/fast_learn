<?php

namespace App\Http\Controllers\Admin\TeacherCheckouts;

use App\Enums\CheckoutEnum;
use App\Http\Controllers\BaseComponent;
use App\Repositories\Interfaces\TeacherCheckoutRepositoryInterface;
use Livewire\WithPagination;

class IndexTeacherCheckout extends BaseComponent
{
    use WithPagination;

    public $status , $placeholder = ' شماره درخواست یا شماره همراه مدرس';

    public $result;

    protected $queryString = ['status'];

    public function __construct($id = null)
    {
        parent::__construct($id);
        $this->checkoutRepository = app(TeacherCheckoutRepositoryInterface::class);
    }

    public function mount()
    {
        $this->authorizing('show_checkouts');
        $this->data['status'] = CheckoutEnum::getStatus();
    }

    public function render()
    {
        $checkouts = $this->checkoutRepository->getAllAdmin($this->search,$this->status,$this->per_page);
        return view('admin.teacher-checkouts.index-teacher-checkout',['checkouts'=>$checkouts])->extends('admin.layouts.admin');
    }

}
