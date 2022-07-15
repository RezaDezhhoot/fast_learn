<?php

namespace App\Mail;

use App\Repositories\Interfaces\SettingRepositoryInterface;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class OrderMail extends Mailable
{
    use Queueable, SerializesModels;

    /**
     * Create a new message instance.
     *
     * @return void
     */
    public $text;
    public function __construct($text)
    {
        $this->text = $text;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        $SettingRepository = app(SettingRepositoryInterface::class);
        $data = [
            'text' => $this->text,
            'name' => $SettingRepository->getRow('name')
        ];
        $email = $this->from($SettingRepository->getRow('email_username'),$data['name']);
        $email->subject('سفارش های کاربر')->view('emails.order', $data);
    }
}
