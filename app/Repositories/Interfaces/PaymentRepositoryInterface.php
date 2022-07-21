<?php


namespace App\Repositories\Interfaces;


use App\Models\Payment;
use App\Models\User;

interface PaymentRepositoryInterface
{
    public function getAllAdminList($ip , $user,$status,$search , $pagination);

    public function find($id);

    public function delete(Payment $payment);

    public function create(User $user , array $data);

    public function newObject();

    public function update(array $data , array $where = []);

    public function get(array $where = []);

    public function getDashboardData($from_date , $to_date);


    public function pay($amount , $gateway , array $config , string $callbackUrl  , callable $callbackFunction);

    public function verify($amount,$gateway,array $config , $transactionId , callable $callbackFunction);

    public function getModelNamespace(): string;
}
