<?php

namespace App\Models;

use App\Enums\ReductionEnum;
use App\Traits\Admin\Searchable;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

/**
 * @property mixed course
 * @property mixed price
 * @method static find($id)
 * @method static findOrFail($id)
 * @method static findMany(array $ids)
 * @method static latest(string $string)
 */
class Episode extends Model
{
    use HasFactory , Searchable;

    protected $guarded = ['id'];

    protected array $searchAbleColumns = ['title'];

    protected $casts = [
        'file_storage' => 'string',
        'video_storage' => 'string',
    ];

    public function course(): BelongsTo
    {
        return $this->belongsTo(Course::class);
    }

    public function setFileAttribute($value)
    {
        $this->attributes['file'] = str_replace(env('APP_URL'), '', $value);
    }

    public function setLocalVideoAttribute($value)
    {
        $this->attributes['local_video'] = str_replace(env('APP_URL'), '', $value);
    }
}
