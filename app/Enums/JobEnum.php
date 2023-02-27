<?php

namespace App\Enums;

use BenSampo\Enum\Enum;

final class JobEnum extends Enum
{
    const SMS = 'sms';
    const EMAIL = 'email';
    const START_EVENT = 'event';
    const DEFAULT = 'default';

    public static function getMainJobCategories(): array
    {
        return [
            self::SMS , self::EMAIL , self::START_EVENT , self::DEFAULT
        ];
    }
}
