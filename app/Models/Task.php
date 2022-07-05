<?php

namespace App\Models;

use App\Traits\Admin\Searchable;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

/**
 * @method static latest(string $string)
 * @method static findOrFail($id)
 * @method static where(string $string, $task)
 * @property mixed name
 * @property array|mixed task
 * @property mixed where
 * @property mixed value
 */
class Task extends Model
{
    use HasFactory ,Searchable;
    protected array $searchAbleColumns = ['name'];

    public static function event()
    {
        return [
            'sms' => 'SMS',
            'notification' => 'NOTIFICATION',
            'sms_email' => 'SMS & EMAIL',
            'sms_notification' => 'SMS & NOTIFICATION',
            'email_notification' => 'EMAIL & NOTIFICATION',
            'sms_email_notification' => 'SMS & EMAIL & NOTIFICATION',
        ];
    }

    public static function tasks()
    {
        return [
            'login' => 'ورود به حساب کاربری',
            'signUp'=> 'ثبت نام',
            'new_ticket' => 'تیکت جدید',#ok
            'ticket_answer' => 'پاسخ تیکت',#ok
            'order_wc_completed' => 'تکمیل شده',
        ];
    }
}
