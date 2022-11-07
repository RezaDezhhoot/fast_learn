<?php

namespace App\Repositories\Classes;

use App\Enums\BankAccountEnum;
use App\Models\BankAccount;
use App\Repositories\Interfaces\BankAccountRepositoryInterface;
use Illuminate\Support\Facades\Auth;

class BankAccountRepository implements BankAccountRepositoryInterface
{

    public function getAllAdmin($search, $status, $per_page)
    {
        return BankAccount::latest('id')->with('user')->when($status , function ($q) use ($status){
            return $q->where('status',$status);
        })->when($search , function ($q) use ($search) {
            return $q->where('title',$search)->orWhereHas('user',function ($q) use ($search) {
                return $q->where('phone',$search);
            });
        })->paginate($per_page);
    }

    public function find($id, array $where = [])
    {
        return BankAccount::where($where)->find($id);
    }

    public function findOrFail($id, array $where = [])
    {
        return BankAccount::where($where)->findOrFail($id);
    }

    public function destroy($id, array $where = [])
    {
        return BankAccount::where($where)->findOrFail($id)->delete();
    }

    public function save(BankAccount $bankAccount)
    {
        $bankAccount->save();
        return $bankAccount;
    }

    public function getAllTeacher($search, $status, $per_page)
    {
        return BankAccount::latest('id')->whereHas('user',function ($q){
            return $q->where('user_id',Auth::id());
        })->when($status,function ($q) use ($status) {
            return $q->where('status',$status);
        })->search($search)->paginate($per_page);
    }

    public function getNewObject()
    {
        return new BankAccount();
    }

    public static function getNew()
    {
        return BankAccount::where('status',BankAccountEnum::PENDING)->count();
    }
}
