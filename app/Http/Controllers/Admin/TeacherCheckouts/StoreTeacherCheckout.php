<?php

namespace App\Http\Controllers\Admin\TeacherCheckouts;

use App\Enums\CheckoutEnum;
use App\Enums\NotificationEnum;
use App\Http\Controllers\BaseComponent;
use App\Repositories\Interfaces\SendRepositoryInterface;
use App\Repositories\Interfaces\TeacherCheckoutRepositoryInterface;
use Illuminate\Support\Facades\Auth;
use Illuminate\Validation\Rule;

class StoreTeacherCheckout extends BaseComponent
{
    public $header , $status , $result , $files , $checkout;

    public function __construct($id = null)
    {
        parent::__construct($id);
        $this->checkoutRepository = app(TeacherCheckoutRepositoryInterface::class);
        $this->sendRepository = app(SendRepositoryInterface::class);
    }

    public function mount($action , $id)
    {
        $this->authorizing('show_checkouts');

        self::set_mode($action);
        if ($this->mode == self::CREATE_MODE) {
            $this->header = 'درخواست جدید';
        } elseif ($this->mode == self::UPDATE_MODE) {
            $this->checkout = $this->checkoutRepository->findOrFail($id);
            $this->status = $this->checkout->status;
            $this->result = $this->checkout->result ?? '';
        }
        $this->data['status'] = CheckoutEnum::getStatus();
    }

    public function store()
    {
        $this->authorizing('edit_checkouts');
        $this->saveInDataBase($this->checkout);
    }

    private function saveInDataBase($model)
    {
        $this->validate([
            'status' => ['required','in:'.implode(',',array_keys(CheckoutEnum::getStatus()))],
            'result' => [Rule::requiredIf(fn()=>$this->status == CheckoutEnum::ERROR),'max:4200']
        ],[],[
            'status' => 'وضعیت',
            'result' => 'نتیجه'
        ]);
        $model->result = $this->result;


        if ($this->checkout->status != $this->status && $this->checkout->status != CheckoutEnum::DONE) {
            switch ($this->status) {
                case CheckoutEnum::DONE:
                    $this->sendRepository->sendNOTIFICATION(
                        " مدرس گرامی تسویه حساب شما به شماره {$this->checkout->id} با موفیت انجام شد ",
                        $this->checkout->user_id,
                        NotificationEnum::TEACHER,
                        $this->checkout->id
                    );
                    break;
                case CheckoutEnum::ERROR:
                    $this->sendRepository->sendNOTIFICATION(
                        " مدرس گرامی تسویه حساب شما به شماره {$this->checkout->id} انجام شود برای بررسی بیشتر نتیجه ارسالی را مشاهده بفرمایید ",
                        $this->checkout->user_id,
                        NotificationEnum::TEACHER,
                        $this->checkout->id
                    );
                    break;
            }
            $model->status = $this->status;
        }
        $model = $this->checkoutRepository->save($model);
        $this->emitNotify('اظلاعات با موفقیت ذخیره شده');

    }

    public function render()
    {
        return view('admin.teacher-checkouts.store-teacher-checkout')->extends('admin.layouts.admin');
    }
}
