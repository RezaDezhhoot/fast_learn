<?php

namespace App\Enums;

use BenSampo\Enum\Enum;


final class TimeLine extends Enum
{
    const VIDEO = 'video';
    const TEXT = 'text';
//    const VIDEO_TEXT = 'video_text';

    public static function TimeLines()
    {
        return [
            self::VIDEO => 'کاربران ویدیو هارا حتما مشاهده کنند',
            self::TEXT => 'کاربران محتوای دروس را حتما بخوانند',
//            self::VIDEO_TEXT => 'کاربران ویویدو ها را مشاهده و محتوای دروس را بخوانند'
        ];
    }
}
