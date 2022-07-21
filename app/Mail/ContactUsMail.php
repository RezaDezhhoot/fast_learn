<?php

namespace App\Mail;

use App\Repositories\Interfaces\SettingRepositoryInterface;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class ContactUsMail extends Mailable
{
    use Queueable, SerializesModels;

    /**
     * Create a new message instance.
     *
     * @return void
     */
    protected string $text;
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
        $name = $SettingRepository->getRow('name');
        $data = [
            'text' => $this->text,
            'name' => $name,
            'subject'=> "{$name} دریافت پاسخ از طرف ",
        ];
        $email = $this->from($SettingRepository->getRow('email_username'),$data['name']);
        return $email->subject(" دریافت پاسخ از طرف {$data['name']}")
            ->view('emails.contact', $data);
    }
}
