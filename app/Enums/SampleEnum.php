<?php

namespace App\Enums;

use BenSampo\Enum\Enum;

final class SampleEnum extends Enum
{
    const DEMO = 'demo';
    const PUBLISHED = 'published';

    const PUBLIC_TYPE = 'public' , PRIVATE_TYPE = 'private';

    public static function getType()
    {
        return [
            self::PUBLIC_TYPE => 'عمومی',
            self::PRIVATE_TYPE => 'خصوصی'
        ];
    }

    public static function getStatus()
    {
        return [
            self::DEMO => 'پیشنویس',
            self::PUBLISHED => 'منتشر شده',
        ];
    }
}
