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

    const PROFESSIONAL = 'professional' , MEDIUM = 'medium' , BEGINNER = 'beginner' , ALL_LEVEL = 'all_level';

    const OFFLINE = 'offline' , IN_PERSON = 'in_person' , ONLINE = 'online' , IN_PERSON_ONLINE = 'in_person_online' , ONLINE_OFFLINE = 'online_offline' ,IN_PERSON_OFFLINE = 'in_person_offline' ;

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
            self::HOLDING => 'در حال برگزاری',
            self::FINISHED => 'اتمام یافته',
        ];
    }

    public static function getTypes(): array
    {
        return [
            self::OFFLINE => 'دوره افلاین',
            self::IN_PERSON => 'دوره حضوری',
            self::ONLINE => 'دوره انلاین',
            self::IN_PERSON_ONLINE => 'انلاین و حضوری',
            self::ONLINE_OFFLINE => 'انلاین و افلاین',
            self::IN_PERSON_OFFLINE => 'افلاین و حضوری',
        ];
    }
}
