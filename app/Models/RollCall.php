<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Casts\Attribute;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Morilog\Jalali\Jalalian;
use Spatie\Activitylog\LogOptions;
use Spatie\Activitylog\Traits\LogsActivity;

/**
 * @property mixed $updated_at
 */
class RollCall extends Model
{
    use HasFactory , LogsActivity;

    public function getActivitylogOptions(): LogOptions
    {
        return LogOptions::defaults();
    }

    protected $guarded = ['id'];

    public $appends = ['last_date'];

    public function lastDate(): Attribute
    {
        return Attribute::make(
            get: fn() => Jalalian::forge($this->updated_at)->format('Y/m/d H:i')
        );
    }
}
