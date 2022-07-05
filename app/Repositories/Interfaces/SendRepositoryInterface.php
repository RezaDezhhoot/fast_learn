<?php


namespace App\Repositories\Interfaces;


interface SendRepositoryInterface
{
    public function sendSMS($message , $number);

    public function sendNOTIFICATION($text , $id , $subject , $model_id);

    public function sendCode($code , $phone);
}
