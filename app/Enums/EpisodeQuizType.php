<?php

namespace App\Enums;

use BenSampo\Enum\Enum;


final class EpisodeQuizType extends Enum
{
    const END = 'at_end';
    const REQUIRED_TIME = 'required_time';

    const OPTIONAL_TIME = 'optional_time';

    public static function getTypes()
    {
        return [
            self::END => 'پایان ویدیو',
            self::REQUIRED_TIME => 'در زمان خاص(اجباری)',
            self::OPTIONAL_TIME => 'در زمان خاص(اختیاری)',
        ];
    }
}
