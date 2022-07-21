<?php

namespace App\Http\Controllers\Admin\Orders;

use App\Enums\OrderEnum;
use App\Events\OrderEvent;
use App\Http\Controllers\BaseComponent;
use App\Repositories\Interfaces\OrderDetailRepositoryInterface;
use App\Repositories\Interfaces\OrderRepositoryInterface;
use Illuminate\Support\Facades\Log;

class StoreOrder extends BaseComponent
{
    public $order , $statuses , $details;

    public function __construct($id = null)
    {
        parent::__construct($id);
        $this->orderRepository = app(OrderRepositoryInterface::class);
        $this->orderDetailRepository = app(OrderDetailRepositoryInterface::class);
    }

    public function mount($action , $id = null)
    {
        $this->authorizing('show_orders');
        $this->set_mode($action);
        if ($this->mode == self::UPDATE_MODE){
            $this->order = $this->orderRepository->find($id);
            $this->statuses = $this->order->details->pluck('status','id');
            $this->details = $this->order->details;
        } else abort(404);

        $this->data['status'] = OrderEnum::getStatus();
    }

    public function store()
    {
        $this->authorizing('edit_orders');
        $this->validate([
            'statuses.*' => ['required','in:'.implode(',',array_keys(OrderEnum::getStatus()))]
        ]);
        $event = false;
        foreach ($this->statuses as $key => $status)
        {
            $detail = null;
            $detail = $this->orderDetailRepository->find($key);
            if ($status != $detail->status)
            {
                if (!$event){
                    try {
                        OrderEvent::dispatch($this->order);
                    } catch (\Exception $e) {
                        Log::error($e->getMessage());
                    }
                    $event = true;
                }
                $detail->status = $status;
                $detail->save();
            }
        }
        $this->emitNotify('اطلاعات با موفقیت ثبت شد');
    }

    public function deleteDetail($key)
    {
        $this->authorizing('delete_orders');
        $id = $this->order->details[$key]->id;
        $this->orderDetailRepository->destroy($id);
        $this->emitNotify(' با موفقیت حذف شد');
        unset($this->order->details[$key]);
    }

    public function delete()
    {
        $this->authorizing('delete_orders');
        $this->orderRepository->destroy($this->order->id);
        $this->emitNotify('سفارش با موفقیت حذف شد');
        return redirect()->route('admin.order');
    }

    public function render()
    {
        return view('admin.orders.store-order')
            ->extends('admin.layouts.admin');
    }
}
