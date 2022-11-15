<?php

namespace App\Http\Controllers\Teacher\BankAccounts;

use App\Enums\BankAccountEnum;
use App\Enums\LastActivitiesEnum;
use App\Http\Controllers\BaseComponent;
use App\Repositories\Interfaces\BankAccountRepositoryInterface;
use App\Repositories\Interfaces\LastActivityRepositoryInterface;
use App\Rules\ChekCardNumber;
use Illuminate\Support\Facades\Auth;

class StoreBankAccount extends BaseComponent
{
    public $header , $card_number , $sheba_number , $title;
    public function __construct($id = null)
    {
        parent::__construct($id);
        $this->bankAccountsRepository = app(BankAccountRepositoryInterface::class);
        $this->lastActivityRepository = app(LastActivityRepositoryInterface::class);
    }

    public function mount($action)
    {
        self::set_mode($action);
        if ($this->mode == self::CREATE_MODE) {
            $this->header = 'حساب جدید';
        } else abort(404);
    }

    public function resetInput()
    {
        $this->reset(['title','card_number','sheba_number']);
    }

    public function store()
    {
        if ($this->mode == self::CREATE_MODE)
        {
            $this->saveInDataBase($this->bankAccountsRepository->getNewObject());
            $this->resetInput();
        }
    }

    private function saveInDataBase($model)
    {
        $this->card_number = preg_replace('/\s/','',$this->card_number);
        $this->sheba_number = preg_replace('/\s/','',$this->sheba_number);
        $this->validate([
            'title' => ['required','string','max:250'],
            'card_number' => ['required',new ChekCardNumber()],
            'sheba_number' => ['required','string','regex:/\b^(ir|IR)(\:|\-|\s)?(\d|\s|\-){23,30}\b$/']
        ],[],[
            'title' => 'عنوان',
            'card_number' => 'شماره کارت',
            'sheba_number' => 'شماره شبا',
        ]);

        $model->title = $this->title;
        $model->card_number = $this->card_number;
        $model->sheba_number = $this->sheba_number;
        $model->user_id = Auth::id();
        $model->status = BankAccountEnum::PENDING;
        $model = $this->bankAccountsRepository->save($model);

        $this->lastActivityRepository->register_activity([
            'user_id' => Auth::id(),
            'subject' => LastActivitiesEnum::appendTitle(LastActivitiesEnum::BANk_ACCOUNTS,'new',$model->title),
            'url' => route('teacher.bankAccounts'),
            'icon' => LastActivitiesEnum::BANk_ACCOUNTS['icon']
        ]);

        $this->emitNotify('اطلاعات با موفقیت ذخیره شده');
    }

    public function render()
    {
        return view('teacher.bank-accounts.store-bank-account')->extends('teacher.layouts.teacher');
    }
}
