<?php

namespace App\Http\Controllers\Admin\Payments;

use App\Enums\PaymentEnum;
use App\Http\Controllers\BaseComponent;
use App\Repositories\Interfaces\PaymentRepositoryInterface;
use Livewire\WithPagination;

class IndexPayment extends BaseComponent
{
    use WithPagination;
    protected $queryString = ['status'];

    public ?string $status = null , $ip = null , $user = null;
    public string $placeholder = '  کد پیگیری یا شماره شناسه';

    public function __construct($id = null)
    {
        parent::__construct($id);
        $this->paymentReporitory = app(PaymentRepositoryInterface::class);
    }

    public function mount()
    {
        $this->data['status'] = PaymentEnum::getStatus();
    }

    public function render()
    {
        $this->authorizing('show_payments');
        $payments = $this->paymentReporitory->getAllAdminList($this->ip,$this->user,$this->status,$this->search,$this->per_page);
        return view('admin.payments.index-payment',['payments'=>$payments])
            ->extends('admin.layouts.admin');
    }
}
