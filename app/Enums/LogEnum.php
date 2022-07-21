<?php

namespace App\Enums;

use BenSampo\Enum\Enum;

final class LogEnum extends Enum
{
    const CREATED = 'created' , UPDATED = 'updated' , DELETED = 'deleted';

    public static function getEvents()
    {
        return [
            self::CREATED => 'ساخته شده',
            self::UPDATED => 'ویرایش شده',
            self::DELETED => 'حذف شده',
        ];
    }
}
