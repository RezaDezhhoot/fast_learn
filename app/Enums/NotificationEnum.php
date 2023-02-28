<?php

namespace App\Enums;

use BenSampo\Enum\Enum;

/**
 * @method static static PUBLIC()
 * @method static static PRIVATE()
 * @method static static ORDER()
 * @method static static AUTH()
 * @method static static TICKET()
 * @method static static ALL()
 * @method static static SECURITY()
 * @method static static USER()
 */
final class NotificationEnum extends Enum
{
    const PUBLIC = 'public' , PRIVATE = 'private';

    const ORDER = 'Order' , AUTH = 'Auth' , TEACHER = 'teacher' , FEE = 'fee';
    const TICKET = 'Ticket' , ALL = 'All' , SECURITY = 'Security' , USER = 'User' , QUIZ = 'Quiz';

    public static function getSubject()
    {
        return [
            self::ORDER => 'سفارش ها',
            self::AUTH => ' احراز هویت',
            self::USER => 'حساب کاربری',
            self::TICKET => 'تیکت',
            self::SECURITY => 'امنیتی',
            self::QUIZ => 'ازمون',
            self::ALL => 'عمومی',
            self::TEACHER => 'مدرسین',
            self::FEE => ' حق التدرس'
        ];
    }

    public static function getType()
    {
        return [
            self::PRIVATE => 'خصوصی',
            self::PUBLIC => 'عمومی',
        ];
    }

    const EMAIL_METHOD = 'email_method' , SMS_METHOD = 'sms_method' , BOTH_METHODS = 'both_methods' , NONE_METHOD = 'none_method';
}
