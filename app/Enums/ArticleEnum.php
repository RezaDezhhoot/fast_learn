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

    public static function getStatus()
    {
        return [
            self::DRAFT => 'پیشنویس',
            self::PUBLISHED => 'منتشر شده',
        ];
    }
}
