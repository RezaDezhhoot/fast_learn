<?php


namespace App\Repositories\Interfaces;


use Illuminate\Contracts\Mail\Mailable as MailableContract;

interface SendRepositoryInterface
{
    public function sendSMS($message , $number);

    public function sendEmail(MailableContract $mailable , $email);

    public function sendNOTIFICATION($text , $id , $subject , $model_id);

    public function sendCode($code , $phone);
}
