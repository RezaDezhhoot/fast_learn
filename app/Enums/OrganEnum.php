<?php

namespace App\Enums;

use BenSampo\Enum\Enum;

final class OrganEnum extends Enum
{
    const ACTIVE = 'active' , NOT_ACTIVE = 'not_active' , PENDING = 'pending';

    public static function getStatus()
    {
        return [
            self::ACTIVE => 'فعال',
            self::NOT_ACTIVE => 'غیر فعال',
            self::PENDING => 'در حال بررسی'
        ];
    }
}
