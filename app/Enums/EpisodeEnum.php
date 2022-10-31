<?php

namespace App\Enums;

use BenSampo\Enum\Enum;

final class EpisodeEnum extends Enum
{
    const PENDING_STATUS = 'pending_status' , REJECTED_STATUS = 'rejected_status' , CONFIRMED_STATUS = 'confirmed_status';

    public static function getStatus()
    {
        return [
            self::PENDING_STATUS => 'در حال بررسی',
            self::REJECTED_STATUS => 'رد شده',
            self::CONFIRMED_STATUS => 'تایید شده',
        ];
    }
}

