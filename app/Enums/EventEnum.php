<?php

namespace App\Enums;

use BenSampo\Enum\Enum;
use JetBrains\PhpStorm\ArrayShape;

/**
 * @method static static OptionOne()
 * @method static static OptionTwo()
 * @method static static OptionThree()
 */
final class EventEnum extends Enum
{
    const EMAIL = 'email';
    const SMS = 'sms';

    const PENDING = 'pending';
    const OK = 'ok';
    const FAILED = 'failed';
    const PROCESSING = 'processing';

    public static function getEvents()
    {
        return [
            self::EMAIL => 'ارسال ایمیل',
            self::SMS => 'ارسال اس ام اس'
        ];
    }

    public static function getStatus()
    {
        return [
            self::PENDING => 'در صف انتظار',
            self::OK => 'انجام شده',
            self::FAILED => 'عملیات ناقص انجام شد',
            self::PROCESSING => 'در حال انجام عملیات',
        ];
    }
}
