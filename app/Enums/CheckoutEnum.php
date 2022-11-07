<?php

namespace App\Enums;

use BenSampo\Enum\Enum;


final class CheckoutEnum extends Enum
{
    const PENDING = 'pending' , DONE = 'done' , ERROR = 'error';

    public static function getStatus()
    {
        return [
            self::PENDING => 'در حال رسیدگی',
            self::DONE => 'انجام شده',
            self::ERROR => 'خظا در فرایند تسویه حساب'
        ];
    }
}
