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

    const OFFLINE = 'offline' , IN_PERSON = 'in_person' , ONLINE = 'online';

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

    #[ArrayShape([self::OFFLINE => "string", self::IN_PERSON => "string", self::ONLINE => "string"])]
    public static function getTypes(): array
    {
        return [
            self::OFFLINE => 'وبینار',
            self::IN_PERSON => 'دوره های آموزشی حضوری',
            self::ONLINE => 'دوره های آموزشی آنلاین',
        ];
    }

    // new course checking

    const NEW_COURSE_PENDING  = 'new_course_pending' ,
        NEW_COURSE_REJECTED = 'new_course_rejected' ,
        NEW_COURSE_ACCEPTED = 'new_course_accepted' ,
        NEW_COURSE_ANSWERED = 'new_course_answered' ,
        NEW_COURSE_TEACHER_ANSWERED = 'new_course_teacher_answered';


    #[ArrayShape([self::NEW_COURSE_PENDING => "string", self::NEW_COURSE_REJECTED => "string", self::NEW_COURSE_ACCEPTED => "string", self::NEW_COURSE_ANSWERED => "string", self::NEW_COURSE_TEACHER_ANSWERED => "string"])]
    public static function getNewCourseStatus(): array
    {
        return [
            self::NEW_COURSE_PENDING => 'در حال بررسی',
            self::NEW_COURSE_REJECTED => 'رد شده',
            self::NEW_COURSE_ACCEPTED => 'تایید شده',
            self::NEW_COURSE_ANSWERED => 'پاسخ داده شده',
            self::NEW_COURSE_TEACHER_ANSWERED => 'پاسخ مدرس',
        ];
    }

}
