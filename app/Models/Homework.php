<?php

namespace App\Models;

use App\Enums\StorageEnum;
use Illuminate\Database\Eloquent\Casts\Attribute;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

/**
 * @method static where(array $where)
 * @method static updateOrCreate(array $key, array $value)
 * @property mixed $storage
 */
class Homework extends Model
{
    use HasFactory;

    protected $guarded = ['id'];

    protected $table = 'homeworks';

    protected $casts = [
        'storage' => 'string',
    ];

    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }

    public function episode() : BelongsTo
    {
        return  $this->belongsTo(Episode::class);
    }

    public function setFileAttribute($value)
    {
        $this->attributes['file'] = str_replace(env('APP_URL').'/storage', '', $value);
    }

    protected function storageLabel(): Attribute
    {
        return Attribute::make(
            get: fn () => in_array($this->storage , array_flip(getAvailableStorages()) ) ? getAvailableStorages()[$this->storage] : ''
        );
    }
}
