<?php

namespace App\Enums;

use BenSampo\Enum\Enum;

/**
 * @method static static STATUS_NOT_PAID()
 * @method static static STATUS_HOLD()
 * @method static static STATUS_PROCESSING()
 * @method static static STATUS_CANCELLED()
 * @method static static STATUS_REFUNDED()
 * @method static static STATUS_COMPLETED()
 */
final class OrderEnum extends Enum
{
    const STATUS_NOT_PAID = 'wc-pending';
    const STATUS_PROCESSING = 'wc-processing';
    const STATUS_CANCELLED = 'wc-cancelled';
    const STATUS_REFUNDED = 'wc-refunded';
    const STATUS_COMPLETED = 'wc-completed';

    public static function getStatus()
    {
        return [
            self::STATUS_NOT_PAID => 'در انتظار پرداخت',
            self::STATUS_PROCESSING => 'در حال پردازش ',
            self::STATUS_CANCELLED => 'در انتظار بازگشت وجه',
            self::STATUS_REFUNDED => 'بازگشت وجه',
            self::STATUS_COMPLETED => 'تکمیل شده',
        ];
    }

}
