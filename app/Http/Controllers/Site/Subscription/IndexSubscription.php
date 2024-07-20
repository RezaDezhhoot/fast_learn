<?php

namespace App\Http\Controllers\Site\Subscription;

use App\Enums\PaymentEnum;
use App\Http\Controllers\BaseComponent;
use App\Models\Subscription;
use App\Repositories\Interfaces\PaymentRepositoryInterface;
use App\Repositories\Interfaces\SettingRepositoryInterface;
use Artesaos\SEOTools\Facades\JsonLd;
use Artesaos\SEOTools\Facades\OpenGraph;
use Artesaos\SEOTools\Facades\SEOMeta;
use Artesaos\SEOTools\Facades\TwitterCard;
use Illuminate\Support\Facades\DB;

class IndexSubscription extends BaseComponent
{
    public $q , $gateways = []  , $gateway;

    public function __construct()
    {
        parent::__construct();

        $this->settingRepository = app(SettingRepositoryInterface::class);
        $this->paymentReporitory = app(PaymentRepositoryInterface::class);
    }
    public function mount()
    {
        SEOMeta::setTitle($this->settingRepository->getRow('title').' اشتراک ها ');
        SEOMeta::setDescription($this->settingRepository->getRow('seoDescription'));
        SEOMeta::addKeyword($this->settingRepository->getRow('seoKeyword',[]));
        OpenGraph::setUrl(url()->current());
        OpenGraph::setTitle($this->settingRepository->getRow('title').' اشتراک ها  ');
        OpenGraph::setDescription($this->settingRepository->getRow('seoDescription'));
        TwitterCard::setTitle($this->settingRepository->getRow('title').' اشتراک ها  ');
        TwitterCard::setDescription($this->settingRepository->getRow('seoDescription'));
        JsonLd::setTitle($this->settingRepository->getRow('title').'اشتراک ها ');
        JsonLd::setDescription($this->settingRepository->getRow('seoDescription'));
        JsonLd::addImage(asset($this->settingRepository->getRow('logo')));
        $this->page_address = [
            'home' => ['link' => route('home') , 'label' => 'صفحه اصلی'],
            'subscriptions' => ['label' => 'اشتراک ها']
        ];

        $gateways = $this->settingRepository->getRow('gateway',[]);
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
    }

    public function render()
    {
        $items = Subscription::query()
            ->latest()
            ->published()
            ->search($this->q)
            ->paginate(10);
        return view('site.subscription.index-subscription' , get_defined_vars())->extends('site.layouts.site.site');
    }

    public function buySub($id): void
    {
        $subscription = Subscription::query()->published()->find($id);

        if (! $subscription) {
            $this->emitNotify('خطا در هنگام پرداخت','warning');
            return;
        }

        if (! $this->gateway) {
            $this->emitNotify('خطا در هنگام پرداخت','warning');
            return;
        }

        $res =  $this->paymentReporitory->pay(
            amount: (int)$subscription->amount*$this->gateways[$this->gateway]['unit'],
            gateway: $this->gateway,
            config: $this->gateways[$this->gateway],
            callbackUrl: route('user.subscription',[$this->gateway,'tab'=>'wallet']),
            callbackFunction: fn($gateway = null,$transactionId = null) => $this->payCallback($subscription,$gateway,$transactionId)
        );
        if (gettype($res) == 'string') {
            $this->emitNotify('خطا در هنگام پرداخت','warning');
        };
    }

    private function payCallback($subscription , $gateway = null, $transactionId = null)
    {
        return DB::transaction(function () use ($subscription , $gateway, $transactionId) {
            try {
                $this->paymentReporitory->create(auth()->user(),[
                    'amount' => $subscription->amount,
                    'payment_gateway' => $gateway,
                    'payment_token' => $transactionId,
                    'model_type' => $subscription->getMorphClass(),
                    'model_id' => $subscription->id,
                    'call_back_url' => route('user.subscription',[$this->gateway]),
                    'ip' => request()->ip()
                ]);
            } catch (\Exception $e) {
                $this->emitNotify('خطا در هنگام پرداخت','warning');
            }
        });
    }
}
