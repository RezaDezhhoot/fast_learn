<?php

namespace App\Enums;

use BenSampo\Enum\Enum;

/**
 * @method static static DRAFT()
 * @method static static PUBLISHED()
 */
final class ArticleEnum extends Enum
{
    const DRAFT = 'draft';
    const PUBLISHED = 'published';

    const NEWS = 'news' , ARTICLES = 'articles';

    public static function getType()
    {
        return [
            self::ARTICLES => 'مقالات',
            self::NEWS => 'اخبار'
        ];
    }

    public static function getStatus()
    {
        return [
            self::DRAFT => 'پیشنویس',
            self::PUBLISHED => 'منتشر شده',
        ];
    }
}
