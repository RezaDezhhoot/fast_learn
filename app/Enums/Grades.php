<?php

namespace App\Enums;

use BenSampo\Enum\Enum;

final class Grades extends Enum
{
    const STUDENT =  'student';
    const COLLEGIAN =  'collegian';
    const OTHER = 'other';

    public static function getItems()
    {
        return [
            self::STUDENT => 'دانش آموز',
            self::COLLEGIAN => 'دانشجو',
            self::OTHER => 'سایر',
        ];
    }
}
