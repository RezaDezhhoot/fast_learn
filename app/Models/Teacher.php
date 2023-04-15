<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Casts\Attribute;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\SoftDeletes;

/**
 * @method static findOrFail($id)
 * @method static count()
 * @method static updateOrCreate(array $key, array $value)
 * @method static where(string $string, $user_id)
 */
class Teacher extends Model
{
    use HasFactory , SoftDeletes;

    protected $guarded = ['id'];

    public $appends = ['short_code','username'];

    public $casts = [
        'panel_status' => 'boolean'
    ];

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
}
