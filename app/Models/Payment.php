<?php

namespace App\Models;

use App\Enums\PaymentEnum;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\MorphTo;
use Morilog\Jalali\Jalalian;
use Spatie\Activitylog\LogOptions;
use Spatie\Activitylog\Traits\LogsActivity;

/**
 * @property mixed created_at
 * @property mixed status_code
 * @method static latest(string $string)
 * @method static findOrFail($id)
 * @method static whereBetween(string $string, string[] $array)
 * @method static where(array $where)
 */
class Payment extends Model
{
    use HasFactory  , LogsActivity;

    protected $guarded = ['id'];

    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }

    public function getDateAttribute(): string
    {
        return Jalalian::forge($this->created_at)->format('%A, %d %B %Y');
    }

    public function getStatusLabel(): string
    {
        return PaymentEnum::getStatus()[$this->status_code];
    }

    public function orders(): belongsTo
    {
        return $this->belongsTo(Order::class,'model_id')->where('model_type','order');
    }

    public function model(): MorphTo
    {
        return $this->morphTo();
    }

    public function getActivitylogOptions(): LogOptions
    {
        return (new LogOptions())->logAll();
    }
}
