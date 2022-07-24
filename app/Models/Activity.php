<?php

namespace App\Models;

use App\Enums\LogEnum;
use App\Enums\PaymentEnum;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Morilog\Jalali\Jalalian;
use Spatie\Activitylog\Models\Activity as LogActivity;

/**
 * @method static latest(string $string)
 * @method static find($id)
 * @property mixed $event
 */
class Activity extends LogActivity
{
    use HasFactory;

    public function getDateAttribute(): string
    {
        return Jalalian::forge($this->created_at)->format('%A, %d %B %Y');
    }

    public function getSubjectLabelAttribute(): string
    {
        return in_array($this->subject_type,array_keys(PaymentEnum::getSubjects())) ?
            PaymentEnum::getSubjects()[$this->subject_type] : 'تنظیمات';
    }

    public function getEventLabelAttribute(): string
    {
        return in_array($this->event,array_keys(LogEnum::getEvents())) ?
            LogEnum::getEvents()[$this->event] : '';
    }

}
