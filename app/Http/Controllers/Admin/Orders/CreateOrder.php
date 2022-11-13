<?php

namespace App\Http\Controllers\Admin\Orders;

use App\Http\Controllers\BaseComponent;
use App\Repositories\Interfaces\CourseRepositoryInterface;
use App\Repositories\Interfaces\OrderDetailRepositoryInterface;
use App\Repositories\Interfaces\OrderRepositoryInterface;
use App\Repositories\Interfaces\EpisodeRepositoryInterface;
use App\Repositories\Interfaces\UserRepositoryInterface;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
use App\Enums\OrderEnum;

class CreateOrder extends BaseComponent
{
    public $user_number , $course_id , $course_title , $wallet = 0 , $reduction = 0 , $total = 0 , $final_total , $key , $item = [];
    public $user , $user_wallet = 0;
    public $details;

    public function __construct($id = null)
    {
        parent::__construct($id);
        $this->orderRepository = app(OrderRepositoryInterface::class);
        $this->orderDetailRepository = app(OrderDetailRepositoryInterface::class);
        $this->courseRepository = app(CourseRepositoryInterface::class);
        $this->episodeRepository = app(EpisodeRepositoryInterface::class);
        $this->userRepository = app(UserRepositoryInterface::class);
    }

    public function mount($action)
    {
        $this->authorizing('edit_orders');
        $this->set_mode($action);
        $this->data['course'] = $this->courseRepository->getAll()->pluck('title','id');
        $this->newDetailsArray();
    }

    public function updatedCourseId()
    {
        if (!empty($this->course_id)) {
            $course = $this->courseRepository->find($this->course_id);
            $this->total = $course->base_price;
            $this->final_total = $course->price;
            $this->reduction = $course->reduction_amount;
            $this->course_title = $course->title;
            if ($this->calculateWallet() >= $this->final_total) {
                $this->wallet = $this->final_total;
                $this->final_total = 0;
            }
        } else {
            $this->wallet = 0;
            $this->reduction = 0;
            $this->final_total = 0;
            $this->total = 0;
        }
        $this->updatedWallet();
    }

    public function updatedWallet()
    {
        $this->final_total = $this->calculateTotal();
        $this->user_wallet = $this->calculateWallet();
    }

    public function updatedReduction()
    {
        $this->final_total = $this->calculateTotal();
    }

    public function updatedUserNumber()
    {
        $this->validateUser();
        if ($this->details->count() == 0) {
            $this->user = $this->userRepository->findBy([['phone',$this->user_number]]);
            $this->user_wallet = $this->calculateWallet();
        }
    }

    public function addDetails()
    {
        $this->validateUser();
        $this->reset('item');
        $this->resetDetails();
        $this->updatedWallet();
        $this->key = -1;
        $this->emitShowModal('details');
    }

    public function deleteDetail($key)
    {
        $this->details = $this->details->reject(function ($value , $k)  use ($key) {
            return $k == $key;
        });
        $this->emitNotify('دوره با موقیت حذف شد');
    }

    public function editDetails($key)
    {
        $this->validateUser();
        $this->reset('item');
        $this->item = $this->details->first(function($v , $k) use($key){
            return $k == $key;
        });
        $this->course_id = $this->item['course_id'];
        $this->wallet = $this->item['wallet_amount'];
        $this->reduction = $this->item['reduction_amount'];
        $this->total = $this->item['total_amount'];
        $this->final_total = $this->item['final_total_amount'];
        $this->key = $key;
        $this->emitShowModal('details');
    }

    public function storeDetails()
    {
        $this->validate([
            'course_id' => ['required','exists:courses,id'],
            'wallet' => ['required','between:0,9999999999999.99999',"max:{$this->calculateWallet()}"],
            'reduction' => ['required','between:0,9999999999999.99999'],
        ],[],[
            'course_id' => 'دوره اموزشی',
            'wallet' => 'مبلغ کیف پول',
            'reduction' => 'مبلغ تخفیف'
        ]);
        if ($this->total != $this->wallet + $this->reduction + $this->final_total) {
            return $this->addError('total_amount','مبلغ نامعتبر');
        }

        if ($this->key == -1) {
            $this->details->push([
                'course_id' => $this->course_id,
                'wallet_amount' => (int)$this->wallet,
                'reduction_amount' => (int)$this->reduction,
                'final_total_amount' => $this->calculateTotal(),
                'total_amount' => $this->total,
                'course_title' => $this->course_title
            ]);
        } else {
            $this->item['course_id'] = $this->course_id;
            $this->item['wallet_amount'] = (int)$this->wallet;
            $this->item['reduction_amount'] = (int)$this->reduction;
            $this->item['final_total_amount'] = $this->calculateTotal();
            $this->item['total_amount'] = $this->total;
            $this->item['course_title'] = $this->course_title;
            $this->details[$this->key] = $this->item;
        }
        $this->emitHideModal('details');
    }

    public function store()
    {
        $this->validateUser();
        $this->validate([
            'details' => ['required','array','min:1']
        ] , [] , [
            'details' => 'دوره'
        ]);
        $order = [
            'user_id' => $this->user->id,
            'user_ip' => $this->user->ip,
            'price' => $this->details->sum('total_amount'),
            'total_price' => $this->details->sum('final_total_amount'),
            'reduction_code' => null,
            'reductions_value' => $this->details->sum('reduction_amount'),
            'wallet_pay' => $this->details->sum('wallet_amount'),
            'discount' => $this->details->sum('reduction_amount'),
            'transactionId' => null,
        ];
        try {
            DB::beginTransaction();
            $order = $this->orderRepository->create($order);
            foreach ($this->details as $value) {
                $detail = $this->orderDetailRepository->create([
                    'course_id' => $value['course_id'],
                    'product_data' => json_encode(['id' => $value['course_id'], 'title' =>  $value['course_title']]),
                    'price' => $value['total_amount'],
                    'total_price' => $value['final_total_amount'],
                    'status' => OrderEnum::STATUS_COMPLETED,
                    'reduction_amount' => $value['reduction_amount'],
                    'wallet_amount' => $value['wallet_amount'],
                    'quantity' => 1,
                    'order_id' => $order->id,
                ]);
                if ($fee = $this->orderDetailRepository->paymentOfFeesIfCourseHasTeacherAndValidIncomingMethod($detail)) {
                    $detail->incoming_method_id = $detail->course->incoming_method_id;
                    $detail->teacher_amount = $fee;
                    $this->orderDetailRepository->save($detail);
                }
            }
            DB::commit();
            if ($this->details->sum('wallet_amount') > 0)
                $this->user->forceWithdraw($this->details->sum('wallet_amount'), ['description' => 'بابت سفارش ' . $order->tracking_code]);
            $this->emitNotify('دوره با موفقیت برای شما ثبت شد');
            $this->reset(['user','user_number','user_wallet']);
            $this->newDetailsArray();
            return true;
        } catch (\Exception $e) {
            DB::rollBack();
            Log::error($e->getMessage());
            $this->emitNotify('خطا در هنگام ثبت دوره','warning');
            return false;
        }
    }

    public function newDetailsArray()
    {
        $this->details = collect([]);
    }

    public function resetDetails()
    {
        $this->reset(['course_id','wallet','reduction','total','key','final_total']);
    }

    public function render()
    {
        return view('admin.orders.create-order')->extends('admin.layouts.admin');
    }

    private function calculateTotal()
    {
        return $this->total - (int)$this->wallet - (int)$this->reduction;
    }

    private function calculateWallet()
    {
        return $this->user->wallet->balance - (int)$this->wallet - ($this->details->sum('wallet_amount') ??0 - $this->item['wallet_amount']??0 );
    }

    private function validateUser()
    {
        $this->validate([
            'user_number' => ['required','exists:users,phone'],
        ],[],[
            'user_number' => 'شماره کاربر',
        ]);
    }
}
