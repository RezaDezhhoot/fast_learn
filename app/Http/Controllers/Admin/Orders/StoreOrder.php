<?php

namespace App\Http\Controllers\Admin\Orders;

use App\Enums\OrderEnum;
use App\Events\OrderEvent;
use App\Http\Controllers\BaseComponent;
use App\Repositories\Interfaces\OrderDetailRepositoryInterface;
use App\Repositories\Interfaces\OrderRepositoryInterface;

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
                    OrderEvent::dispatch($this->order);
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
        unset($this->order->details[$key]);
    }

    public function render()
    {
        return view('admin.orders.store-order')
            ->extends('admin.layouts.admin');
    }
}
