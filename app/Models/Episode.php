<?php

namespace App\Models;

use App\Enums\ReductionEnum;
use App\Enums\StorageEnum;
use App\Traits\Admin\Searchable;
use Dyrynda\Database\Support\CascadeSoftDeletes;
use Illuminate\Database\Eloquent\Casts\Attribute;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\HasOne;
use Illuminate\Database\Eloquent\SoftDeletes;

/**
 * @property mixed course
 * @property mixed price
 * @property mixed $file_storage
 * @property mixed $video_storage
 * @property mixed $homework_storage
 * @method static find($id)
 * @method static findOrFail($id)
 * @method static findMany(array $ids)
 * @method static latest(string $string)
 * @method static whereHas(string $string, \Closure $param)
 */
class Episode extends Model
{
    use HasFactory , Searchable , SoftDeletes , CascadeSoftDeletes;

    protected $cascadeDeletes = ['homeworks','transcripts'];

    protected $guarded = ['id'];

    protected array $searchAbleColumns = ['title'];

    protected $casts = [
        'file_storage' => 'string',
        'video_storage' => 'string',
        'homework_storage' => 'string',
    ];

    public function course(): BelongsTo
    {
        return $this->belongsTo(Course::class);
    }

    public function setFileAttribute($value)
    {
        $this->attributes['file'] = str_replace(env('APP_URL').'/storage', '', $value);
    }

    public function setLocalVideoAttribute($value)
    {
        $this->attributes['local_video'] = str_replace(env('APP_URL').'/storage', '', $value);
    }

    public function homeworks(): HasMany
    {
        return $this->hasMany(Homework::class);
    }

    protected function homeworksCount(): Attribute
    {
        return Attribute::make(
            get: fn () => $this->homeworks()->count()
        );
    }

    protected function fileStorageLabel(): Attribute
    {
        return Attribute::make(
            get: fn () => in_array($this->file_storage , array_flip(getAvailableStorages()) ) ? getAvailableStorages()[$this->file_storage] : ''
        );
    }

    protected function videoStorageLabel(): Attribute
    {
        return Attribute::make(
            get: fn () => in_array($this->video_storage , array_flip(getAvailableStorages()) ) ?  getAvailableStorages()[$this->video_storage] : ''
        );
    }

    protected function homeworkStorageLabel(): Attribute
    {
        return Attribute::make(
            get: fn () => in_array($this->homework_storage , array_flip(getAvailableStorages()) ) ?  getAvailableStorages()[$this->homework_storage] : ''
        );
    }

    public function transcripts(): HasMany
    {
        return $this->hasMany(EpisodeTranscript::class);
    }
}
