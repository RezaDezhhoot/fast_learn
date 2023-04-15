<?php

namespace App\Enums;

use BenSampo\Enum\Enum;

final class FormEnum extends Enum
{
    const TEACHER = 'teacher' , STUDENT = 'student' , ORGAN = 'organ' , USER = 'user' , COURSES = 'course';

    const PUBLISHED = 'published' , DRAFT = 'draft';

    public static function getStatus()
    {
        return [
            self::PUBLISHED => 'منتشر شده',
            self::DRAFT => 'پیشنویس',
        ];
    }

    public static function getSubjects()
    {
        return [
            self::TEACHER => 'مدریسن',
            self::STUDENT => 'دانش اموزان',
            self::ORGAN => 'موسسه ها',
            self::USER => 'کل کاربران',
            self::COURSES => 'دروه های اموزشی'
        ];
    }
}
