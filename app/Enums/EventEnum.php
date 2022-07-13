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

    const ASC = 'asc' , DESC = 'desc';

    #[ArrayShape([self::ASC => "string", self::DESC => "string"])]
    public static function getOrderBy(): array
    {
        return [
            self::ASC => 'از اول',
            self::DESC => 'از اخر'
        ];
    }

    #[ArrayShape([self::EMAIL => "string", self::SMS => "string"])]
    public static function getEvents(): array
    {
        return [
            self::EMAIL => 'ارسال ایمیل',
            self::SMS => 'ارسال اس ام اس'
        ];
    }

    #[ArrayShape([self::PENDING => "string", self::OK => "string", self::FAILED => "string", self::PROCESSING => "string"])]
    public static function getStatus(): array
    {
        return [
            self::PENDING => 'در صف انتظار',
            self::OK => 'انجام شده',
            self::FAILED => 'عملیات ناقص انجام شد',
            self::PROCESSING => 'در حال انجام عملیات',
        ];
    }
}
