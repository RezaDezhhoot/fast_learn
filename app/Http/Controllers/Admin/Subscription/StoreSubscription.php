<?php

namespace App\Http\Controllers\Admin\Subscription;

use App\Enums\SubscriptionEnum;
use App\Http\Controllers\BaseComponent;
use App\Models\Subscription;
use Illuminate\Validation\Rule;
use Livewire\WithPagination;

class StoreSubscription extends BaseComponent
{
    public $header;

    public $subscription , $title , $amount , $status , $description , $value , $image;

    public function mount($action , $id = null)
    {
        $this->set_mode($action);
        if ($this->mode == self::UPDATE_MODE) {
            $this->subscription = Subscription::query()->findOrFail($id);
            $this->header = $this->subscription->title;
            $this->title = $this->subscription->title;
            $this->image = $this->subscription->image;
            $this->description = $this->subscription->description;
            $this->status = $this->subscription->status;
            $this->amount = $this->subscription->amount;
            $this->value = $this->subscription->value;
        } elseif ($this->mode == self::CREATE_MODE) {
            $this->header = 'اشتراک جدید';
        } else abort(404);
        $this->data['status'] = SubscriptionEnum::getStatus();
    }

    public function store()
    {
        if ($this->mode == self::UPDATE_MODE)
            $this->saveInDB($this->subscription);
        elseif ($this->mode == self::CREATE_MODE) {
            $this->saveInDB(new Subscription());
            redirect()->route('admin.subscription');
        }
    }

    public function saveInDB(Subscription $subscription)
    {
        $this->validate([
            'title' => ['required','string','max:100'],
            'image' => ['required','string','max:10000'],
            'description' => ['nullable','string','max:10000'],
            'amount' => ['required','numeric','min:1000'],
            'value' => ['required','numeric','min:1000'],
            'status' => ['required','string',Rule::in(array_keys($this->data['status']))]
        ] ,[] , [
            'title' => 'عنوان',
            'status' => 'وضعیت',
            'image' => 'تصویر',
            'description' => 'توضیحات',
            'amount' => 'مبلغ',
            'value' => 'مقدار پول'
        ]);

        $data = [
            'title' => $this->title,
            'status' => $this->status,
            'image' => $this->image,
            'value' => $this->value,
            'amount' => $this->amount,
            'description' => $this->description,
        ];

        try {
            $subscription->fill($data)->save();
            $this->emitNotify('اطلاعات با موفقیت ثبت شد');
        } catch (\Exception $e) {

        }
    }

    public function deleteItem()
    {
        $this->subscription->delete();
        redirect()->route('admin.subscription');
    }

    public function render()
    {
        return view('admin.subscription.store-subscription')->extends('admin.layouts.admin');
    }
}
