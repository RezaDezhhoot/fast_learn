<?php

namespace App\Enums;

use BenSampo\Enum\Enum;


final class CheckoutEnum extends Enum
{
    const PENDING = 'pending' , DONE = 'done' , ERROR = 'error';


    const TYPE_ORGAN = 'organ', TYPE_TEACHER = 'teacher';

    public static function getType()
    {
        return [
            self::TYPE_ORGAN => 'تسویه حساب سازمانی',
            self::TYPE_TEACHER => 'تسویه حساب مدرس',
        ];
    }

    public static function getStatus()
    {
        return [
            self::PENDING => 'در حال رسیدگی',
            self::DONE => 'انجام شده',
            self::ERROR => 'خظا در فرایند تسویه حساب'
        ];
    }
}
