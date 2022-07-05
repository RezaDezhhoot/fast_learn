<?php


namespace App\Repositories\Interfaces;


use App\Models\OrderDetail;

interface OrderDetailRepositoryInterface
{
    public function find($id);

    public function destroy($id);

    public function create(array $data);

    public function save(OrderDetail $orderDetail);

    public function getDashboardData($from_date , $to_date , $course_id = null);

    public function getDashboardDataPayments($from_date , $to_date , $sum , $course_id = null);
}
