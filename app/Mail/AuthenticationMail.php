<?php

namespace App\Mail;

use App\Enums\UserEnum;
use App\Repositories\Interfaces\SettingRepositoryInterface;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Support\Facades\Log;

class AuthenticationMail extends Mailable
{
    use Queueable, SerializesModels;

    /**
     * Create a new message instance.
     *
     * @return void
     */
    public $user , $text , $event;
    public function __construct($user,$text)
    {
        $this->user = $user;
        $this->text = $text;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build(): bool|static
    {
        $SettingRepository = app(SettingRepositoryInterface::class);
        $data = [
            'text' => $this->text,
            'user'=> $this->user,
            'name' => $SettingRepository->getRow('name')
        ];
        return $this->from($SettingRepository
            ->getRow('email_username'),$data['name'])
            ->subject('احراز هویت')
            ->view('emails.authentication',$data);
    }
}
