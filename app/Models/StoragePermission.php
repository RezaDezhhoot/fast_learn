<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Casts\Attribute;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Spatie\Activitylog\LogOptions;
use Spatie\Activitylog\Traits\LogsActivity;

/**
 * @method static latest(string $string)
 * @method static findOrFail($id)
 * @method static find($id)
 */
class StoragePermission extends Model
{
    use HasFactory , LogsActivity;

    public function getActivitylogOptions(): LogOptions
    {
        return LogOptions::defaults();
    }

    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }

    public function storage(): BelongsTo
    {
        return $this->belongsTo(Storage::class);
    }

    public function path(): Attribute
    {
        return Attribute::make(
            get: fn($value) => json_decode($value,true),
            set: fn($value) => json_encode($value)
        );
    }
}
