<?php

namespace App\Http\Controllers\Admin\BankAccounts;

use App\Enums\BankAccountEnum;
use App\Http\Controllers\BaseComponent;
use App\Repositories\Interfaces\BankAccountRepositoryInterface;
use Livewire\Component;
use Livewire\WithPagination;

class IndexBankAccount extends BaseComponent
{
    use WithPagination;

    public $status , $placeholder = 'عنوان حساب یا شماره همراه مدرس';

    protected $queryString = ['status'];

    public function __construct($id = null)
    {
        parent::__construct($id);
        $this->bankAccountsRepository = app(BankAccountRepositoryInterface::class);
    }

    public function mount()
    {
        $this->authorizing('show_bank_accounts');
        $this->data['status'] = BankAccountEnum::getStatus();
    }

    public function render()
    {
        $accounts = $this->bankAccountsRepository->getAllAdmin($this->search ,$this->status , $this->per_page);
        return view('admin.bank-accounts.index-bank-account',['accounts'=>$accounts])->extends('admin.layouts.admin');
    }

    public function delete($id)
    {
        $this->authorizing('delete_bank_accounts');
        $this->bankAccountsRepository->destroy($id);
    }
}
