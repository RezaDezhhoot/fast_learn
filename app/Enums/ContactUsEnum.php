<?php

namespace App\Enums;

use BenSampo\Enum\Enum;
use JetBrains\PhpStorm\ArrayShape;


final class ContactUsEnum extends Enum
{
    const PENDING = 'pending';
    const CHECKED =  'checked';
    const FAILED = 'failed';

    const EMAIL_ACTION = 'email_action' , SMS_ACTION = 'sms_action';

    #[ArrayShape([self::EMAIL_ACTION => "string", self::SMS_ACTION => "string"])]
    public static function getActions(): array
    {
        return [
            self::EMAIL_ACTION => 'ارسال ایمیل',
            self::SMS_ACTION => 'ارسال اس ام اس'
        ];
    }

    #[ArrayShape([self::PENDING => "string", self::CHECKED => "string",self::FAILED => "string"])]
    public static function getStatus(): array
    {
        return [
            self::PENDING => 'در انتظار پاسخ',
            self::CHECKED => 'بررسی شده',
            self::FAILED => 'خطا در ارسال پاسخ',
        ];
    }
}
