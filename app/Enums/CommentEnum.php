<?php

namespace App\Enums;

use BenSampo\Enum\Enum;

/**
 * @method static static CONFIRMED()
 * @method static static NOT_CONFIRMED()
 * @method static static ARTICLE()
 * @method static static COURSE()
 */
final class CommentEnum extends Enum
{
    const CONFIRMED = 'confirmed';
    const NOT_CONFIRMED =  'not_confirmed';

    const ARTICLE = 'App\Models\Article' , COURSE = 'App\Models\Course';

    public static function getStatus()
    {
        return [
            self::CONFIRMED => 'تایید شده',
            self::NOT_CONFIRMED => 'تایید نشده',
        ];
    }

    public static function getFor()
    {
        return [
            self::ARTICLE => 'مقالات اموزشی',
            self::COURSE => 'دوره اموزشی',
        ];
    }

    public static function model()
    {
        return [
            self::ARTICLE => 'article',
            self::COURSE => 'course',
        ];
    }
}
