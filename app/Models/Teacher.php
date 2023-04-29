<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Casts\Attribute;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\SoftDeletes;
use Spatie\Activitylog\LogOptions;
use Spatie\Activitylog\Traits\LogsActivity;

/**
 * @method static findOrFail($id)
 * @method static count()
 * @method static updateOrCreate(array $key, array $value)
 * @method static where(string $string, $user_id)
 */
class Teacher extends Model
{
    use HasFactory , SoftDeletes , LogsActivity;

    public function getActivitylogOptions(): LogOptions
    {
        return LogOptions::defaults();
    }

    protected $guarded = ['id'];

    public $appends = ['short_code','username'];

    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }

    public function courses(): HasMany
    {
        return $this->hasMany(Course::class);
    }

    public function getShortCodeAttribute(): string
    {
        return base64_encode($this->id);
    }

    public function username(): Attribute
    {
        return Attribute::make(
            get: fn() => $this->user->name
        );
    }

    public function organs(): BelongsToMany
    {
        return $this->belongsToMany(Organ::class,'teacher_has_organs');
    }
}
