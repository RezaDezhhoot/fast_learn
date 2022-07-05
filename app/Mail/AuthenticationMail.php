<?php

namespace App\Mail;

use App\Enums\UserEnum;
use App\Repositories\Interfaces\SettingRepositoryInterface;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class AuthenticationMail extends Mailable
{
    use Queueable, SerializesModels;

    /**
     * Create a new message instance.
     *
     * @return void
     */
    public $user , $text , $event;
    public function __construct($user,$text,$event)
    {
        $this->user = $user;
        $this->text = $text;
        $this->event = $event;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build(): static
    {
        $SettingRepository = app(SettingRepositoryInterface::class);
        $data = [
            'text' => $this->text,
            'user'=> $this->user,
            'logo'=> url($SettingRepository->getRow('logo')),
            'name' => $SettingRepository->getRow('name')
        ];
        $email = $this->from($SettingRepository->getRow('email_username'),$data['name']);

        return match ($this->event) {
            UserEnum::LOGIN_EVENT => $email->subject('ورود به ناحیه کاربری')
                ->view('emails.login', $data),

            UserEnum::AUTHENTICATE_EVENT => $email->subject('احراز هویت')
                ->view('emails.authentication',$data),

            UserEnum::REGISTER_EVENT => $email->subject('ثبت نام')
                ->view('emails.register',$data)
        };
    }
}
