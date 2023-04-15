<?php

namespace App\Models;

use App\Enums\CommentEnum;
use App\Enums\ReductionEnum;
use App\Enums\StorageEnum;
use App\Traits\Admin\Searchable;
use Carbon\Carbon;
use Cviebrock\EloquentSluggable\Sluggable;
use Dyrynda\Database\Support\CascadeSoftDeletes;
use Illuminate\Database\Eloquent\Casts\Attribute;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\HasOne;
use Illuminate\Database\Eloquent\Relations\MorphMany;
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

    protected $cascadeDeletes = ['homeworks','transcripts','comments','likes'];

    protected $guarded = ['id'];

    protected array $searchAbleColumns = ['title'];

    protected $casts = [
        'file_storage' => 'string',
        'video_storage' => 'string',
        'homework_storage' => 'string',
        'free' => 'boolean',
        'show_api_video' => 'boolean',
        'downloadable_local_video' => 'boolean',
        'can_homework' => 'boolean',
    ];

    protected $appends = [
        'time_label'
    ];

    public function reports(): HasMany
    {
        return $this->hasMany(ViolationReport::class);
    }

    public function comments(): MorphMany
    {
        return $this->morphMany(Comment::class, 'commentable')->latest('id')->where('status',CommentEnum::CONFIRMED)
            ->with(['childrenRecursive' => function($q) {
                return $q->where('status',CommentEnum::CONFIRMED);
            }])->whereNull('parent_id');
    }

    public function timeLabel(): Attribute
    {
        return Attribute::make(
            get: fn() => Carbon::make($this->time)->format('H:i') != '00:00' ? Carbon::make($this->time)->format('H:i') : ''
        );
    }

    public function chapter(): BelongsTo
    {
        return $this->belongsTo(Chapter::class);
    }

    public function setFileAttribute($value)
    {
        $this->attributes['file'] = ltrim( $value,env('APP_URL').'/storage');
    }

    public function setLocalVideoAttribute($value)
    {
        $this->attributes['local_video'] = ltrim( $value,env('APP_URL').'/storage');
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

    public function likes(): HasMany
    {
        return $this->hasMany(EpisodeLike::class);
    }

    public function rollCalls(): HasMany
    {
        return $this->hasMany(RollCall::class);
    }
}
