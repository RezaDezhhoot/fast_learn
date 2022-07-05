<?php

namespace App\Enums;

use BenSampo\Enum\Enum;

/**
 * @method static static NOT_CONFIRMED()
 * @method static static CONFIRMED()
 * @method static static WAIT_TO_CONFIRM()
 */
final class UserEnum extends Enum
{
    const NOT_CONFIRMED = 'not_confirmed';
    const CONFIRMED = 'confirmed';
    const WAIT_TO_CONFIRM = 'wait_for_confirm';

    const LOGIN_EVENT = 'login' , REGISTER_EVENT = 'register' , AUTHENTICATE_EVENT = 'authenticate';

    public static function getStatus()
    {
        return [
            self::NOT_CONFIRMED => 'تایید نشده',
            self::CONFIRMED => 'تایید شده',
            self::WAIT_TO_CONFIRM => 'در انتظار تایید',
        ];
    }
}
