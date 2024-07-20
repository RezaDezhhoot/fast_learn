<?php

namespace App\Http\Controllers\Site\Client;

use App\Enums\PaymentEnum;
use App\Http\Controllers\BaseComponent;
use App\Repositories\Interfaces\PaymentRepositoryInterface;
use App\Repositories\Interfaces\SettingRepositoryInterface;
use Livewire\Component;

class Subscription extends BaseComponent
{
    public $token , $gateways = [] , $gateway , $subscription;
    protected $queryString = ['token'];
    public $isSuccessful, $message;

    public function __construct($id = null)
    {
        parent::__construct($id);
        $this->settingRepository = app(SettingRepositoryInterface::class);
        $this->paymentReporitory = app(PaymentRepositoryInterface::class);
    }

    public function mount($gateway)
    {
        if (request()->exists('id'))
            $this->token =request()->id;
        elseif (request()->exists('Authority'))
            $this->token = request()->Authority;
        else abort(404);

        $this->page_address = [
            'home' => ['link' => route('home') , 'label' => 'صفحه اصلی'],
            'subscriptions_verify' => ['label' => 'جزئیات خرید اشتراک ']
        ];

        $gateways = $this->settingRepository->getRow('gateway',[]);
        $this->gateway = $gateway;
        foreach ($gateways as $key => $item)
        {
            if ($key == 0)
                $this->gateway = $item;

            $this->gateways[$item] = [
                'merchantId' => $this->settingRepository->getRow("{$item}_merchantId"),
                'title' => $this->settingRepository->getRow("{$item}_title"),
                'logo' => $this->settingRepository->getRow("{$item}_logo"),
                'sandbox' => (bool)$this->settingRepository->getRow("{$item}_sandbox") ?? null,
                'mode' => $this->settingRepository->getRow("{$item}_mode") ?? null,
                'unit' => (int)$this->settingRepository->getRow("{$item}_unit") ?? 1,
            ];
        }

        if (isset($this->token)) {
            $this->getSubscription();
            if (! $this->subscription) abort(404);

            try {
                $payment = $this->paymentReporitory->get([ ['payment_token', $this->token] ]);
                $result = $this->paymentReporitory->verify(
                    $payment->amount*$this->gateways[$gateway]['unit'],
                    $gateway,
                    $this->gateways[$gateway],
                    $this->token,
                    function($payment = null,$amount = null) {
                        $this->verifyCallback($payment);
                    }
                );
                if (!$result){
                    $this->isSuccessful = false;
                    $this->message = 'پرداخت ناموفق بود';
                } else {
                    $this->isSuccessful = true;
                    $this->message = 'پرداخت با موفقیت انجام شد ';
                }
            }   catch (\Exception $exception) {
                $this->isSuccessful = true;
                $this->message = 'پرداخت با موفقیت انجام شد ';
            }
            $this->reset(['token']);
        }
    }


    private function getSubscription()
    {
        $paymentRepository = $this->paymentReporitory;
        if (!is_null($this->token)) {
            $transaction = $paymentRepository->get([
                ['payment_gateway', $this->gateway],['payment_token', $this->token],['model_type', (new \App\Models\Subscription())->getMorphClass()]
            ]);
            if (! $transaction) {
                abort(404);
            }
            $this->subscription = \App\Models\Subscription::query()->find($transaction->model_id);
        }
    }

    private function verifyCallback( $payment = null , $price = null): void
    {
        $paymentRepository = app(PaymentRepositoryInterface::class);
        if (!is_null($payment) && empty($paymentRepository->get([['payment_ref', $payment->getReferenceId()]])) ) {
            $paymentRepository->update([
                'payment_ref' => $payment->getReferenceId(),
                'status_code' => '100',
                'status_message' => 'پرداخت با موفقیت انجام شد',
            ],[['payment_token', $this->token]]);

            auth()->user()->deposit($this->subscription->value, ['description' => 'خرید اشتراک', 'from_admin'=> true]);
        }
    }

    public function render()
    {
        return view('site.client.subscription')->extends('site.layouts.client.client');
    }
}
