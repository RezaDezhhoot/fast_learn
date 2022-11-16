<?php

namespace App\Http\Controllers\Admin\BankAccounts;

use App\Enums\BankAccountEnum;
use App\Enums\NotificationEnum;
use App\Http\Controllers\BaseComponent;
use App\Repositories\Interfaces\BankAccountRepositoryInterface;
use App\Repositories\Interfaces\SendRepositoryInterface;
use Illuminate\Validation\Rule;

class StoreBankAccount extends BaseComponent
{
    public $account , $status , $result , $header;
    public function __construct($id = null)
    {
        parent::__construct($id);
        $this->bankAccountsRepository = app(BankAccountRepositoryInterface::class);
        $this->sendRepository = app(SendRepositoryInterface::class);
    }

    public function mount($action , $id)
    {
        $this->authorizing('show_bank_accounts');
        $this->set_mode($action);
        if ($this->mode == self::UPDATE_MODE)
        {
            $this->account = $this->bankAccountsRepository->findOrFail($id);
            $this->header = " حساب بانکی {$this->account->title}";
            $this->status = $this->account->status;
        } else abort(404);

        $this->data['status'] = BankAccountEnum::getStatus();
    }

    public function store()
    {
        $this->authorizing('edit_bank_accounts');
        $this->saveInDataBase($this->account);
    }

    private function saveInDataBase($model)
    {
        $this->validate([
            'status' => ['required','string','in:'.implode(',',array_keys(BankAccountEnum::getStatus()))],
            'result' => ['max:250',Rule::requiredIf(fn() => $this->status == BankAccountEnum::SUSPENDED || $this->status == BankAccountEnum::REJECTED)],
        ],[],[
            'status' => 'وضعیت',
            'result' => 'علت',
        ]);

        $model->status = $this->status;
        $model = $this->bankAccountsRepository->save($model);
        if ($model->wasChanged('status')) {
            if ($this->status == BankAccountEnum::SUSPENDED)
                $text = "   مدرس گرامی حساب بانکی شما با شماره کارت {$this->account->card_number} به دلیل {$this->result} به حالت تعلیق درامد ";
            elseif ($this->status == BankAccountEnum::AVAILABLE)
                $text = "  مدرس گرامی حساب بانکی شما با شماره کارت   {$this->account->card_number} تایید شد ";
            elseif ($this->status == BankAccountEnum::REJECTED)
                $text = "   مدرس گرامی حساب بانکی شما با شماره کارت {$this->account->card_number} به دلیل {$this->result} رد شد ";

            if (!empty($text))
                $this->sendRepository->sendNOTIFICATION($text,$this->account->user_id,NotificationEnum::TEACHER,$model->id);
        }
        $this->emitNotify('اطلاعات با موفقیت ذحیره شد');
    }

    public function deleteItem()
    {
        $this->authorizing('delete_bank_accounts');
        $this->bankAccountsRepository->destroy($this->account->id);
        return redirect()->route('admin.account');
    }

    public function render()
    {
        return view('admin.bank-accounts.store-bank-account')->extends('admin.layouts.admin');
    }
}
