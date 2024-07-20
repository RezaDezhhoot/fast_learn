<?php

namespace App\Http\Controllers\Admin\Subscription;

use App\Enums\SubscriptionEnum;
use App\Http\Controllers\BaseComponent;
use App\Models\Subscription;
use Livewire\WithPagination;

class IndexSubscription extends BaseComponent
{
    use WithPagination;

    public $status , $placeholder = 'عنوان';

    protected $queryString = ['status'];

    public function mount()
    {
        $this->data['status'] = SubscriptionEnum::getStatus();
    }


    public function delete($id)
    {
        Subscription::destroy($id);
    }

    public function render()
    {
        $items = Subscription::query()
            ->latest()
            ->when($this->status , function ($q) {
                $q->where('status',$this->status);
            })->when($this->search , function ($q) {
                $q->search($this->search);
            })->paginate($this->per_page);

        return view('admin.subscription.index-subscription' ,  get_defined_vars())->extends('admin.layouts.admin');
    }
}
