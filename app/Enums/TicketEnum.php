<?php

namespace App\Enums;

use BenSampo\Enum\Enum;

/**
 * @method static static HIGH()
 * @method static static NORMAL()
 * @method static static LOW()
 * @method static static ADMIN()
 * @method static static USER()
 * @method static static PENDING()
 * @method static static ANSWERED()
 * @method static static USER_ANSWERED()
 */
final class TicketEnum extends Enum
{
    const HIGH = 'high';
    const NORMAL = 'normal';
    const LOW = 'low';

    const ADMIN = 'admin' , USER = 'user';

    const PENDING = 'pending' , ANSWERED = 'answered' , USER_ANSWERED = 'user_answered' , ADMIN_SENT = 'admin_sent';

    public static function getSenderType()
    {
        return [
            self::ADMIN => 'ادمین',
            self::USER => 'کاربر',
        ];
    }

    public static function getPriority()
    {
        return [
            self::HIGH => 'زیاد',
            self::NORMAL => 'متوسط',
            self::LOW => 'کم'
        ];
    }

    public static function getStatus()
    {
        return [
            self::PENDING => 'در انتظار پاسخ',
            self::ANSWERED => 'پاسخ داده شد',
            self::USER_ANSWERED => 'پاسخ مشتری',
            self::ADMIN_SENT => 'ازسال از طرف مدیریت',
        ];
    }
}
