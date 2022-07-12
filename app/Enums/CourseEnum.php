<?php

namespace App\Enums;

use BenSampo\Enum\Enum;
use JetBrains\PhpStorm\ArrayShape;

/**
 * @method static static DRAFT()
 * @method static static COMING_SOON()
 * @method static static HOLDING()
 * @method static static FINISHED()
 */
final class CourseEnum extends Enum
{
    const DRAFT = 'draft';
    const COMING_SOON = 'coming_soon';
    const HOLDING = 'holding';
    const FINISHED = 'finished';

    const UPLOAD_FILE_THROUGH_PATH = 'upload_file_through_path';
    const UPLOAD_FILE_THROUGH_SITE = 'upload_file_through_site';

    const PROFESSIONAL = 'professional' , MEDIUM = 'medium' , BEGINNER = 'beginner' , ALL_LEVEL = 'all_level';

    #[ArrayShape([self::BEGINNER => "string", self::MEDIUM => "string", self::PROFESSIONAL => "string", self::ALL_LEVEL => "string"])]
    public static function getLevels(): array
    {
        return [
            self::BEGINNER => 'مبتدی',
            self::MEDIUM => 'متوسط',
            self::PROFESSIONAL => 'حرفه ای',
            self::ALL_LEVEL => 'همه سطوح',
        ];
    }

    #[ArrayShape([self::DRAFT => "string", self::COMING_SOON => "string", self::HOLDING => "string", self::FINISHED => "string"])]
    public static function getStatus(): array
    {
        return [
            self::DRAFT => 'پیشنویس',
            self::COMING_SOON => 'به زودی',
            self::HOLDING => 'در حال برگذاری',
            self::FINISHED => 'اتمام یافته',
        ];
    }
}