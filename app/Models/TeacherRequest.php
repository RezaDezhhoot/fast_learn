<?php

namespace App\Models;

use App\Enums\TeacherEnum;
use Illuminate\Database\Eloquent\Casts\Attribute;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Morilog\Jalali\Jalalian;
use Spatie\Activitylog\LogOptions;
use Spatie\Activitylog\Traits\LogsActivity;

/**
 * @method static create(array $data)
 * @method static where(string $string, string $APPLY_PENDING)
 * @method static latest(string $string)
 * @method static findOrFail($id)
 * @property mixed $status
 */
class TeacherRequest extends Model
{
    protected $guarded = [];
    use HasFactory , LogsActivity;

    public function getActivitylogOptions(): LogOptions
    {
        return LogOptions::defaults();
    }

    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }

    public function createdAt(): Attribute
    {
        return Attribute::make(
            get: fn($value) => Jalalian::forge($value)->format('%A, %d %B %Y')
        );
    }

    public function statusLabel(): Attribute
    {
        return Attribute::make(
            get: fn() => in_array($this->status,array_keys(TeacherEnum::getStatus())) ? TeacherEnum::getStatus()[$this->status] : 'نامشخص'
        );
    }

    public function getFilesAttribute($value)
    {
        if (!is_null($value))
            return explode(',',$value);

        return null;
    }
}
