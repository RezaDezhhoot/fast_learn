<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Casts\Attribute;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Morilog\Jalali\Jalalian;

/**
 * @property mixed $updated_at
 */
class RollCall extends Model
{
    use HasFactory;

    protected $guarded = ['id'];

    public $appends = ['last_date'];

    public function lastDate(): Attribute
    {
        return Attribute::make(
            get: fn() => Jalalian::forge($this->updated_at)->format('Y/m/d H:i')
        );
    }
}
