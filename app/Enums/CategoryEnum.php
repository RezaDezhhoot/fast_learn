<?php

namespace App\Enums;

use BenSampo\Enum\Enum;

/**
 * @method static static COURSE()
 * @method static static ARTICLE()
 * @method static static QUESTION()
 */
final class CategoryEnum extends Enum
{
    const COURSE =  'course';
    const ARTICLE = 'article';
    const QUESTION = 'question';

    public static function getTypes()
    {
        return [
            self::ARTICLE => 'مقالات',
            self::COURSE => 'دوره ها',
            self::QUESTION => 'سوالات',
        ];
    }
}
