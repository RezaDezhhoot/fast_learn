<?php

namespace App\Enums;

use BenSampo\Enum\Enum;

/**
 * @method static static SUCCESS()
 */
final class PaymentEnum extends Enum
{
    const SUCCESS = 100;
    const OptionTwo =   1;
    const OptionThree = 2;

    public static function getStatus()
    {
        return [
            self::SUCCESS => 'موق',
            '8' => 'به درگاه پرداخت منتقل شد',
            '10' => 'در انتظار تایید پرداخت',
        ];
    }
}
