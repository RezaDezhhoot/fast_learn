<?php

namespace App\Repositories\Classes;

use App\Enums\CheckoutEnum;
use App\Models\TeacherCheckout;
use App\Repositories\Interfaces\TeacherCheckoutRepositoryInterface;
use Illuminate\Support\Facades\Auth;

class TeacherCheckoutRepository implements TeacherCheckoutRepositoryInterface
{

    public function getAllAdmin($search, $status, $per_page)
    {
        return TeacherCheckout::latest('id')->with('user')->when($search,function ($q) use ($search){
            return $q->search($search)->orWhereHas('user',function ($q) use ($search) {
               return $q->where('phone',$search);
            });
        })->when($status , function ($q) use ($status) {
            return $q->where('status',$status);
        })->paginate($per_page);
    }

    public function destroy($id)
    {
        // TODO: Implement destroy() method.
    }

    public function save(TeacherCheckout $checkout)
    {
        $checkout->save();
        return $checkout;
    }

    public function getAllTeacher($search, $status, $per_page)
    {
        return TeacherCheckout::latest('id')->with('user')->whereHas('user',function ($q){
            return $q->where('id',Auth::id());
        })->search($search)->when($status , function ($q) use ($status) {
            return $q->where('status',$status);
        })->paginate($per_page);
    }

    public function getNewObject()
    {
        return new TeacherCheckout();
    }

    public static function getNew()
    {
        return TeacherCheckout::where('status',CheckoutEnum::PENDING)->count();
    }

    public function findOrFail($id, $where = [])
    {
        return TeacherCheckout::where($where)->findOrFail($id);
    }
}
