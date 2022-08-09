<?php

namespace App\Http\Controllers\Site\Carts;

use App\Enums\OrderEnum;
use App\Enums\PaymentEnum;
use App\Enums\QuizEnum;
use App\Events\OrderEvent;
use App\Http\Controllers\BaseComponent;
use App\Http\Controllers\Cart\Facades\Cart;
use App\Repositories\Interfaces\OrderDetailRepositoryInterface;
use App\Repositories\Interfaces\OrderNoteRepositoryInterface;
use App\Repositories\Interfaces\OrderRepositoryInterface;
use App\Repositories\Interfaces\PaymentRepositoryInterface;
use App\Repositories\Interfaces\SettingRepositoryInterface;
use App\Repositories\Interfaces\TranscriptRepositoryInterface;
use Artesaos\SEOTools\Facades\OpenGraph;
use Artesaos\SEOTools\Facades\SEOMeta;
use Illuminate\Support\Facades\Log;

class Verify extends BaseComponent
{
    public $isSuccessful, $message , $order , $gateways = [] ;
    public $gateway  ,$tracking;
    public $address , $status  , $order_id , $token;
    protected $queryString = ['token','tracking'];

    public function __construct($id = null)
    {
        parent::__construct($id);
        $this->settingRepository = app(SettingRepositoryInterface::class);
        $this->orderRepository = app(OrderRepositoryInterface::class);
        $this->orderDetailRepository = app(OrderDetailRepositoryInterface::class);
        $this->paymentReporitory = app(PaymentRepositoryInterface::class);
        $this->transcriptRepository = app(TranscriptRepositoryInterface::class);
        $this->orderNoteRepository = app(OrderNoteRepositoryInterface::class);
    }

    public function mount($gateway = null)
    {
        SEOMeta::setTitle('جزییات پرداخت');
        OpenGraph::setUrl(url()->current());
        $gateways = $this->settingRepository->getRow('gateway',[]);
        foreach ($gateways as $item)
        {
            $this->gateways[$item] = [
                'merchantId' => $this->settingRepository->getRow("{$item}_merchantId"),
                'logo' => $this->settingRepository->getRow("{$item}_logo"),
                'sandbox' => (bool)$this->settingRepository->getRow("{$item}_sandbox") ?? null,
                'mode' => $this->settingRepository->getRow("{$item}_mode") ?? null,
                'unit' => (int)$this->settingRepository->getRow("{$item}_unit") ?? 1,
            ];
        }
        $this->page_address = [
            'home' => ['link' => route('home') , 'label' => 'صفحه اصلی'],
            'checkout' => ['link' => '' , 'label' => 'جزییات پرداخت']
        ];

        if (request()->exists('id'))
            $this->token =request()->id;
        elseif (request()->exists('Authority'))
            $this->token = request()->Authority;

        $this->gateway = $gateway;
        $this->getOrder();
        if (is_null($this->gateway)) {
            $this->success();
        } else {
            $result =  $this->paymentReporitory->verify(
                $this->order->total_price*$this->gateways[$this->gateway]['unit'],
                $this->gateway,
                $this->gateways[$gateway],
                $this->token,
                fn($payment = null,$amount = null) => $this->success($payment)
            );
            if (!$result){
                $this->isSuccessful = false;
                $this->message = 'پرداخت ناموفق بود';
            } else {
                $this->isSuccessful = true;
                $this->message = 'پرداخت با موفقیت انجام شد ';
            }
        }
        try {
            OrderEvent::dispatch($this->order);
        } catch (\Exception $e) {
            Log::error($e->getMessage());
        }
        Cart::destroy();
    }

    private function success($payment = null)
    {
        $this->isSuccessful = true;
        $this->message = 'پرداخت با موفقیت انجام شد با تشکر از خرید شما';

        if (!is_null($payment) && empty($this->paymentReporitory->get([['payment_ref', $payment->getReferenceId()]]) ) ) {
            $this->paymentReporitory->update([
                'payment_ref' => $payment->getReferenceId(),
                'status_code' => '100',
                'status_message' => 'پرداخت با موفقیت انجام شد',
            ],[['payment_token', $this->token]]);
            $this->orderNoteRepository->create([
                'note' => 'پرداخت با موفقیت انجام شد. کد پیگیری درگاه: ' . $payment->getReferenceId(),
                'is_user_note' => 1,
                'is_read' => 0,
                'order_id' => $this->order->id,
            ]);
        }
        foreach ($this->order->details as $detail) {
            $detail->status = OrderEnum::STATUS_COMPLETED;
            $this->orderDetailRepository->save($detail);
            if (!is_null($detail->course->quiz)) {
                $quiz = $detail->course->quiz;
                for ($i=0;$i<$quiz->enter_count;$i++) {
                    $this->transcriptRepository->create([
                        'user_id' => auth()->id(),
                        'quiz_id' => $quiz->id,
                        'course_id' => $detail->course->id,
                        'result' => QuizEnum::PENDING,
                        'course_data' => json_encode([
                            'id' => $detail->course->id,
                            'title' => $detail->course->title,
                        ])
                    ]);
                }
            }
        }
        if ($this->order->wallet_pay > 0)
            auth()->user()->forceWithdraw($this->order->wallet_pay, ['description' => 'بابت سفارش ' . $this->order->tracking_code]);
    }

    private function getOrder()
    {
        $orderRepository = $this->orderRepository;
        $paymentRepository = $this->paymentReporitory;
        if (!is_null($this->token)) {
            $transaction = $paymentRepository->get([
                ['payment_gateway', $this->gateway],['payment_token', $this->token],['model_type', ['model_type', PaymentEnum::order()]]
            ]);
            $this->order = $orderRepository->get([['user_id', auth()->id()],['id', $transaction->model_id]]);
        } else {
            $this->order = $orderRepository->get([
                ['user_id', auth()->id()],
                ['total_price' ,0],
                ['id',(int)$this->tracking - $this->orderRepository::CHANGE_ID() ],
            ]);
        }
    }

    public function try_again()
    {
        if (!$this->isSuccessful)
        {
            if ($error =  $this->paymentReporitory->pay(
                amount: $this->order->total_price*$this->gateways[$this->gateway]['unit'],
                gateway: $this->gateway,
                config: $this->gateways[$this->gateway],
                callbackUrl: env('APP_URL') . "/verify/{$this->gateway}",
                callbackFunction: fn($gateway = null,$transactionId = null) => $this->store($gateway,$transactionId)
            )) $this->addError('payment',$error);
        }
    }

    private function store($gateway = null,$transactionId = null)
    {
        if (!is_null($gateway)) {
            $this->paymentReporitory->update([
                'payment_token' => $transactionId,
            ],[['payment_token', $this->token]]);
        }
    }

    public function render()
    {
        return view('site.carts.verify')->extends('site.layouts.site.site');
    }
}
