<?php

namespace App\Http\Controllers\Organ\Checkouts;

use App\Enums\CheckoutEnum;
use App\Http\Controllers\BaseComponent;
use App\Repositories\Interfaces\TeacherCheckoutRepositoryInterface;
use Bavix\Wallet\Exceptions\BalanceIsEmpty;
use Bavix\Wallet\Exceptions\InsufficientFunds;
use Illuminate\Support\Facades\Auth;

class StoreCheckout extends BaseComponent
{

    public $header;
    public $price , $account;
    public function __construct($id = null)
    {
        parent::__construct($id);
        $this->checkoutRepository = app(TeacherCheckoutRepositoryInterface::class);
    }

    public function mount($action)
    {
        self::set_mode($action);
        if ($this->mode == self::CREATE_MODE) {
            $this->header = 'درخواست جدید';
        } else abort(404);
        $this->data['account'] = Auth::user()->accounts->pluck('title','id');
    }

    public function store()
    {
        $this->saveInDataBase($this->checkoutRepository->getNewObject());
    }

    private function saveInDataBase($model)
    {
        $this->validate([
            'price' => ['required','numeric','between:5000,'.Auth::user()->wallet->balance],
            'account' => ['required','in:'.implode(',',array_keys($this->data['account']))]
        ],[],[
            'price' => 'مبلغ',
            'account' => 'حساب بانکی',
        ]);
        try {
            Auth::user()->forceWithdraw($this->price, ['description' => 'درخواست تسویه حساب', 'from_admin'=> true]);
        } catch (BalanceIsEmpty | InsufficientFunds $exception) {
            $this->addError('price', $exception->getMessage());
        }
        $model->user_id = Auth::id();
        $model->price = $this->price;
        $model->status = CheckoutEnum::PENDING;
        $account = Auth::user()->accounts->where('id',$this->account)->first();
        $model->bank_account_info = [
            'card_number' => $account->card_number,
            'sheba_number' => $account->sheba_number
        ];
        $model->author = CheckoutEnum::TYPE_ORGAN;
        $this->checkoutRepository->save($model);

        $this->emitNotify('درخواست تسویه حساب با موفقیت ثبت شده');
        $this->reset(['price']);
    }

    public function render()
    {
        return view('organ.checkouts.store-checkout')->extends('organ.layouts.organ');
    }
}
