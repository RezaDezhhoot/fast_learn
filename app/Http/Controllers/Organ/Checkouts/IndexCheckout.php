<?php

namespace App\Http\Controllers\Organ\Checkouts;

use App\Enums\CheckoutEnum;
use App\Http\Controllers\BaseComponent;
use App\Repositories\Interfaces\TeacherCheckoutRepositoryInterface;
use Livewire\Component;
use Livewire\WithPagination;

class IndexCheckout extends BaseComponent
{
    use WithPagination;

    public $status , $placeholder = 'شماره درخواست';

    public $result;

    protected $queryString = ['status'];

    public function __construct($id = null)
    {
        parent::__construct($id);
        $this->checkoutRepository = app(TeacherCheckoutRepositoryInterface::class);
    }

    public function mount()
    {
        $this->data['status'] = CheckoutEnum::getStatus();
    }

    public function render()
    {
        $checkouts = $this->checkoutRepository->getAllTeacher($this->search,$this->status,$this->per_page);
        return view('organ.checkouts.index-checkout',get_defined_vars())->extends('organ.layouts.organ');
    }

    public function show_details($key)
    {
        $this->reset(['result']);
        $this->result = auth()->user()->checkouts->filter(function ($v,$k) use ($key){
            return $v['id'] == $key;
        })->first()->result;
    }
}
