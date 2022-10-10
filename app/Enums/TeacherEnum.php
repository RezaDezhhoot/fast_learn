<?php

namespace App\Enums;

use BenSampo\Enum\Enum;

final class TeacherEnum extends Enum
{
    const APPLY_PENDING = 'pending';
    const APPLY_REJECTED = 'rejected';
    const APPLY_CONFIRMED = 'confirmed';


    public static function getStatus()
    {
        return [
            self::APPLY_CONFIRMED => 'تایید شده',
            self::APPLY_PENDING => 'در حال بررسی',
            self::APPLY_REJECTED => 'رد شده'
        ];
    }
}
