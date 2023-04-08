<?php

namespace App\Enums;

use BenSampo\Enum\Enum;

final class CertificateEnum extends Enum
{
    const DEMO = 'demo' , ORIGINAL = 'original';

    const DEFAULT = 'default' , CUSTOM = 'custom';

    public static function getContentType(): array
    {
        return [
            self::DEFAULT => 'متن پیشفرض',
            self::CUSTOM => 'متن شخصی سازی شده',
        ];
    }
}
