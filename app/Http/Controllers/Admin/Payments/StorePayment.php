<?php

namespace App\Http\Controllers\Admin\Payments;

use App\Enums\PaymentEnum;
use App\Http\Controllers\BaseComponent;
use App\Repositories\Interfaces\PaymentRepositoryInterface;
use App\Repositories\Interfaces\SettingRepositoryInterface;

class StorePayment extends BaseComponent
{
    public $payment , $header  , $json;

    public function __construct($id = null)
    {
        parent::__construct($id);
        $this->paymentReporitory = app(PaymentRepositoryInterface::class);
    }

    public function mount($action , $id = null)
    {
        $this->authorizing('show_payments');
        $this->set_mode($action);
        if ($this->mode == self::UPDATE_MODE)
        {
            $this->payment = $this->paymentReporitory->find($id);
            $this->header = 'رسید پرداخت شماره '.$id;
        } else abort(404);
        $this->json = json_decode($this->payment->json,true);
        $this->data['status'] = PaymentEnum::getStatus();
    }

    public function render()
    {
        return view('admin.payments.store-payment')
            ->extends('admin.layouts.admin');
    }

    public function deleteItem()
    {
        $this->authorizing('delete_payments');
        $this->paymentReporitory->delete($this->payment);
        return redirect()->route('admin.payment');
    }
}
