<?php

namespace App\Enums;

use BenSampo\Enum\Enum;

/**
 * @method static static PERCENT()
 * @method static static CONST()
 * @method static static ACCEPTED()
 * @method static static REJECTED()
 * @method static static SUSPENDED()
 */
final class QuizEnum extends Enum
{
    const PERCENT = 'percent';
    const CONST = 'const';

    const PASSED = 'accepted' , REJECTED = 'rejected' , SUSPENDED = 'suspended' , PENDING = 'pending';

    const SHOW_SIDE_BY_SIDE = 'show_side_by_side' , SHOW_BELOW  = 'show_below';

    public static function getViews()
    {
        return [
            self::SHOW_SIDE_BY_SIDE => 'نمایش گزینه ها کنار هم',
            self::SHOW_BELOW => 'نمایش گزینه ها زیر هم',
        ];
    }

    public static function getType()
    {
        return [
            self::PERCENT => 'درصدی',
            self::CONST => 'ثابت',
        ];
    }

    public static function getResult()
    {
        return [
            self::PASSED => 'قبول',
            self::REJECTED => 'رد',
            self::SUSPENDED => 'معلق',
            self::PENDING => 'جدید',
        ];
    }
}
