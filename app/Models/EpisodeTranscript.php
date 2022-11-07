<?php

namespace App\Models;

use App\Enums\EpisodeEnum;
use App\Traits\Admin\Searchable;
use Illuminate\Database\Eloquent\Casts\Attribute;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

/**
 * @property mixed $status
 * @property mixed $file_storage
 * @property mixed $video_storage
 * @property mixed $title
 * @property mixed $file
 * @property mixed $link
 * @property mixed $local_video
 * @property mixed $allow_show_local_video
 * @property mixed $time
 * @property mixed $view
 * @property mixed $course_id
 * @property mixed $free
 * @property mixed $show_api_video
 * @property mixed $downloadable_local_video
 * @property mixed $description
 * @property mixed $can_homework
 * @property mixed $homework_storage
 * @method static create(array $data)
 * @method static latest(string $string)
 * @method static find($id)
 * @method static findOrFail($id)
 * @method static whereHas(string $string, \Closure $param)
 * @method static where(string $string, string $PENDING_STATUS)
 */
class EpisodeTranscript extends Model
{
    use HasFactory , Searchable;

    protected $guarded = ['id'];

    protected $casts = [
        'file_storage' => 'string',
        'video_storage' => 'string',
        'homework_storage' => 'string',
    ];

    protected array $searchAbleColumns = ['title'];

    public function course(): BelongsTo
    {
        return $this->belongsTo(Course::class);
    }

    public function episode(): BelongsTo
    {
        return $this->belongsTo(Episode::class);
    }

    public function statusLabel(): Attribute
    {
        return Attribute::make(
            get: fn() => in_array($this->status,array_keys(EpisodeEnum::getStatus())) ? EpisodeEnum::getStatus()[$this->status] : 'نامشخص'
        );
    }

    public function setFileAttribute($value)
    {
        $this->attributes['file'] = str_replace(env('APP_URL').'/storage', '', $value);
    }

    public function setLocalVideoAttribute($value)
    {
        $this->attributes['local_video'] = str_replace(env('APP_URL').'/storage', '', $value);
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
}
