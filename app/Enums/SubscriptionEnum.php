<?php

namespace App\Enums;

use BenSampo\Enum\Enum;

/**
 * @method static static OptionOne()
 * @method static static OptionTwo()
 * @method static static OptionThree()
 */
final class SubscriptionEnum extends Enum
{
    const PUBLISHED =  'published';
    const DRAFT =  'draft';

    public static function getStatus()
    {
        return [
            self::DRAFT => 'پیشنویس',
            self::PUBLISHED => 'منتسشر شده'
        ];
    }
}
