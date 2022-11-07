<?php

namespace App\Http\Controllers\Teacher\BankAccounts;

use App\Enums\BankAccountEnum;
use App\Http\Controllers\BaseComponent;
use App\Repositories\Interfaces\BankAccountRepositoryInterface;
use Illuminate\Support\Facades\Auth;

class IndexBankAccount extends BaseComponent
{
    public $status , $placeholder = 'عنوان حساب یا شماره همراه مدرس';
    protected $queryString = ['status'];

    public function __construct($id = null)
    {
        parent::__construct($id);
        $this->bankAccountsRepository = app(BankAccountRepositoryInterface::class);
    }

    public function mount()
    {
        $this->data['status'] = BankAccountEnum::getStatus();
    }

    public function delete($id)
    {
        $this->bankAccountsRepository->destroy($id,[['user_id',Auth::id()]]);
    }

    public function render()
    {
        $accounts = $this->bankAccountsRepository->getAllTeacher($this->search,$this->status , $this->per_page);
        return view('teacher.bank-accounts.index-bank-account',['accounts'=>$accounts])->extends('teacher.layouts.teacher');
    }
}
