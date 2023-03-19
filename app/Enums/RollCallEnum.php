<?php

namespace App\Enums;

use BenSampo\Enum\Enum;

final class RollCallEnum extends Enum
{
    const PRESENT = 'present';
    const ABSENT = 'absent' ;

    public static function getStatus()
    {
        return [
            self::PRESENT => '✅',
            self::ABSENT => '❌'
        ];
    }
}
