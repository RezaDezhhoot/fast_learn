<?php

namespace App\Http\Controllers\Organ\Orders;

use App\Enums\OrderEnum;
use App\Http\Controllers\BaseComponent;
use App\Repositories\Interfaces\OrderDetailRepositoryInterface;
use Livewire\WithPagination;

class IndexOrder extends BaseComponent
{
    use WithPagination;
    protected $queryString = ['status'];
    public $status , $pagination , $placeholder = 'کد پیگیری سبد یا خرده سفارش یا شماره همراه';

    public function __construct($id = null)
    {
        parent::__construct($id);
        $this->orderDetailRepository = app(OrderDetailRepositoryInterface::class);
    }

    public function mount()
    {
        $this->data['status'] = OrderEnum::getStatus();
    }

    public function render()
    {
        $orders = $this->orderDetailRepository->getAllOrgan($this->search , $this->status , $this->per_page);
        return view('organ.orders.index-order',get_defined_vars())
            ->extends('organ.layouts.organ');
    }
}
