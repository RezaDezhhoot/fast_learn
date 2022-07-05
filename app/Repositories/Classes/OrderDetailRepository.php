<?php


namespace App\Repositories\Classes;

use App\Enums\OrderEnum;
use App\Enums\PaymentEnum;
use App\Models\OrderDetail;
use App\Models\Payment;
use App\Repositories\Interfaces\OrderDetailRepositoryInterface;

class OrderDetailRepository implements OrderDetailRepositoryInterface
{
    public function find($id)
    {
        return OrderDetail::findOrFail($id);
    }

    public function destroy($id): int
    {
        return OrderDetail::destroy($id);
    }

    public function create(array $data)
    {
        return OrderDetail::create($data);
    }

    public function save(OrderDetail $orderDetail): OrderDetail
    {
         $orderDetail->save();
        return $orderDetail;
    }

    public function getDashboardData($from_date , $to_date , $course_id = null)
    {
        return OrderDetail::whereBetween('created_at', [$from_date." 00:00:00", $to_date." 23:59:59"])
            ->where('status',OrderEnum::STATUS_COMPLETED)->when($course_id , function ($q) use ($course_id){
                return $q->wherehas('course',function ($q) use ($course_id) {
                    return $q->where('id',$course_id);
                });
            })->count();
    }

    public function getDashboardDataPayments($from_date , $to_date , $sum , $course_id = null)
    {
        return $this->getDashboardDataQuery($from_date , $to_date , $sum , $course_id);
    }

    public function getDashboardDataQuery($from_date , $to_date , $sum , $course_id = null)
    {
        return OrderDetail::whereBetween('created_at', [$from_date." 00:00:00", $to_date." 23:59:59"])->where('status',OrderEnum::STATUS_COMPLETED)
            ->when($course_id , function ($q) use ($course_id){
                return $q->wherehas('course',function ($q) use ($course_id) {
                    return $q->where('id',$course_id);
                });
            })->sum($sum);
    }
}
