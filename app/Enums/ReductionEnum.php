<?php

namespace App\Enums;

use BenSampo\Enum\Enum;

/**
 * @method static static PERCENT()
 * @method static static AMOUNT()
 */
final class ReductionEnum extends Enum
{
    const PERCENT = 'percent';
    const AMOUNT = 'amount';

    public static function getType()
    {
        return [
            self::PERCENT => 'درصد',
            self::AMOUNT => 'ثابت',
        ];
    }
}
