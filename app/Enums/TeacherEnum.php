<?php

namespace App\Enums;

use BenSampo\Enum\Enum;
use JetBrains\PhpStorm\ArrayShape;

final class TeacherEnum extends Enum
{
    const APPLY_PENDING = 'pending';
    const APPLY_REJECTED = 'rejected';
    const APPLY_CONFIRMED = 'confirmed';


    #[ArrayShape([self::APPLY_CONFIRMED => "string", self::APPLY_PENDING => "string", self::APPLY_REJECTED => "string"])]
    public static function getStatus(): array
    {
        return [
            self::APPLY_CONFIRMED => 'تایید شده',
            self::APPLY_PENDING => 'در حال بررسی',
            self::APPLY_REJECTED => 'رد شده'
        ];
    }
}
