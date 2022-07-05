<?php

namespace App\Mail;

use App\Repositories\Interfaces\SettingRepositoryInterface;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class EventMail extends Mailable
{
    use Queueable, SerializesModels;

    /**
     * Create a new message instance.
     *
     * @return void
     */
    public $subject,$text;
    public function __construct($subject,$text)
    {
        $this->text = $text;
        $this->subject = $subject;
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
            'name' => $SettingRepository->getRow('name'),
            'subject'=> $this->subject,
        ];
        $email = $this->from($SettingRepository->getRow('email_username'),$data['name']);
        return $email->subject($this->subject)->view('emails.event',$data);
    }
}
