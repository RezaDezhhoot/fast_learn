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

    CONST TEN_ONE = [10,0] , TEN_TWO = [10,1] , TEN_THREE = [10,2] , TEN_FOUR = [10,3] , TEN_FIVE = [10,4] , TEN_SIX = [10,5] , TEN_SEVEN = [10,6] , TEN_EIGHT = [10,7] ,
        TEN_NINE = [10,8]  , TEN_TEN = [10,9];
    CONST TWENTY_ONE = [5,0] , TWENTY_TWO = [5,1] , TWENTY_THREE = [5,2] , TWENTY_FOUR = [5,3] , TWENTY_FIVE = [5,4];
    CONST TWENTY_Five_ONE = [4,0] , TWENTY_Five_TWO = [4,1] , TWENTY_Five_THREE = [4,2] , TWENTY_Five_FOUR = [4,3] ;
    const THIRTY_ONE = [3,0] , THIRTY_TWO = [3,1] , THIRTY_THREE = [3,2];
    const FIFTY_ONE = [2,0] ,  FIFTY_TWO = [2,1] ;
    const ALL = 0;

    public static function getNumbers()
    {
        return [
            'همه',

            '10 درصد اول' ,
            '10 درصد دوم' ,
            '10 درصد سوم' ,
            '10 درصد چهارم' ,
            '10 درصد پنجم' ,

            '10 درصد ششم' ,
            '10 درصد هفتم' ,
            '10 درصد هشتم' ,
            '10 درصد نهم' ,
            '10 درصد دهم' ,

            '20 درصد اول' ,
            '20 درصد دوم' ,
            '20 درصد سوم' ,
            '20 درصد چهارم' ,
            '20 درصد پنجم' ,
            '25 درصد اول' ,
            '25 درصد دوم' ,
            '25 درصد سوم' ,
            '25 درصد چهارم' ,
            '33 درصد اول',
            '33 درصد دوم',
            '33 درصد سوم' ,
            '50 درصد اول',
            '50 درصد دوم' ,
        ];
    }

    public static function getPriods()
    {
        return [
            self::ALL,

            self::TEN_ONE,
            self::TEN_TWO,
            self::TEN_THREE,
            self::TEN_FOUR,
            self::TEN_FIVE,
            self::TEN_SIX,
            self::TEN_SEVEN,
            self::TEN_EIGHT,
            self::TEN_NINE,
            self::TEN_TEN,
        

            self::TWENTY_ONE,
            self::TWENTY_TWO,
            self::TWENTY_THREE,
            self::TWENTY_FOUR,
            self::TWENTY_FIVE,

            self::TWENTY_Five_ONE,
            self::TWENTY_Five_TWO,
            self::TWENTY_Five_THREE,
            self::TWENTY_Five_FOUR,

            self::THIRTY_ONE,
            self::THIRTY_TWO,
            self::THIRTY_THREE,
            
            self::FIFTY_ONE,
            self::FIFTY_TWO
        ];
    }

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
