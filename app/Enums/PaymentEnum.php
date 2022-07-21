<?php

namespace App\Enums;

use App\Repositories\Interfaces\OrderRepositoryInterface;
use App\Repositories\Interfaces\PaymentRepositoryInterface;
use App\Repositories\Interfaces\UserRepositoryInterface;
use BenSampo\Enum\Enum;
use JetBrains\PhpStorm\ArrayShape;

/**
 * @method static static SUCCESS()
 */
final class PaymentEnum extends Enum
{
    const SUCCESS = 100;
    const OptionTwo =   1;
    const OptionThree = 2;

    #[ArrayShape([self::SUCCESS => "string", '8' => "string", '10' => "string"])]
    public static function getStatus(): array
    {
        return [
            self::SUCCESS => 'موق',
            '8' => 'به درگاه پرداخت منتقل شد',
            '10' => 'در انتظار تایید پرداخت',
        ];
    }

    public static function user(): string
    {
        return app(UserRepositoryInterface::class)->getModelNamespace();
    }

    public static function order(): string
    {
        return app(OrderRepositoryInterface::class)->getNameSpace();
    }

    public static function payment(): string
    {
        return app(PaymentRepositoryInterface::class)->getModelNamespace();
    }

    public static function getSubjects(): array
    {
        return [
            self::user() => 'پنل کاربری',
            self::order() => 'سفارش ها',
            self::payment() => 'پرداخت ها',
        ];
    }
}
