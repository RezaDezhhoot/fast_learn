<?php

namespace App\Http\Controllers\Admin\Orders;

use App\Enums\OrderEnum;
use App\Http\Controllers\BaseComponent;
use Livewire\WithPagination;
use App\Repositories\Interfaces\OrderRepositoryInterface;

class IndexOrder extends BaseComponent
{
    use WithPagination;
    protected $queryString = ['status'];
    public $status , $pagination , $placeholder = 'کد پیگیری سبد یا خرده سفارش یا شماره همراه';

    public function __construct($id = null)
    {
        parent::__construct($id);
        $this->orderRepository = app(OrderRepositoryInterface::class);
    }

    public function mount()
    {
        $this->data['status'] = OrderEnum::getStatus();
    }

    public function render()
    {
        $this->authorizing('show_orders');
        $orders = $this->orderRepository->getAllAdmin($this->search , $this->status , $this->per_page);
        return view('admin.orders.index-order',['orders' => $orders])->extends('admin.layouts.admin');
    }
}
