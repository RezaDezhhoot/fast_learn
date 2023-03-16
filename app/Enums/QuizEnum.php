<?php

namespace App\Enums;

use BenSampo\Enum\Enum;

/**
 * @method static static PERCENT()
 * @method static static CONST()
 * @method static static ACCEPTED()
 * @method static static REJECTED()
 * @method static static SUSPENDED()
 */
final class QuizEnum extends Enum
{
    const PERCENT = 'percent';
    const CONST = 'const';

    // results :
    const PASSED = 'accepted' , REJECTED = 'rejected' , SUSPENDED = 'suspended' ,
        PENDING = 'pending' , ON_QUEUE = 'on_queue' , ON_PROCESSING = 'on_processing' , PROCESS_BY_TEACHER = 'process_by_teacher' , ERROR = 'error';

    // show questions :
    const SHOW_SIDE_BY_SIDE = 'show_side_by_side' , SHOW_BELOW  = 'show_below';

    const PROCESS_NOW = 'process_now' , PROCESS_ON_QUEUE = 'process_on_queue';

    const CHANGE_CHOICE = 12;


    public static function getViews()
    {
        return [
            self::SHOW_SIDE_BY_SIDE => 'نمایش گزینه ها کنار هم',
            self::SHOW_BELOW => 'نمایش گزینه ها زیر هم',
        ];
    }

    public static function getType()
    {
        return [
            self::PERCENT => 'درصدی',
            self::CONST => 'ثابت',
        ];
    }

    public static function getResult()
    {
        return [
            self::PASSED => 'قبول',
            self::REJECTED => 'رد',
            self::SUSPENDED => 'معلق',
            self::PENDING => 'جدید',
            self::ON_PROCESSING => ' در حال تصحیح ازمون توسط سیستم',
            self::PROCESS_BY_TEACHER => 'در انتظار تصحیح توسط مدرس',
            self::ON_QUEUE => 'در صف انتظار',
            self::ERROR => 'خظا در هنگام پردازش'
        ];
    }

}
