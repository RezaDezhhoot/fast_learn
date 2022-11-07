<?php

namespace App\Enums;

use BenSampo\Enum\Enum;

final class BankAccountEnum extends Enum
{
    const PENDING = 'pending' , SUSPENDED = 'suspended' , AVAILABLE = 'available' , REJECTED = 'rejected';

    public static function getStatus()
    {
        return [
            self::PENDING => 'در حال بررسی',
            self::SUSPENDED => 'معلق',
            self::AVAILABLE => 'فعال',
            self::REJECTED => 'رد شده',
        ];
    }
}
