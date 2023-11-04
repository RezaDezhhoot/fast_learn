<?php

namespace App\Models;

use App\Enums\ChapterEnum;
use App\Enums\CommentEnum;
use App\Traits\Admin\Searchable;
use Cviebrock\EloquentSluggable\Sluggable;
use Dyrynda\Database\Support\CascadeSoftDeletes;
use Illuminate\Database\Eloquent\Casts\Attribute;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\MorphMany;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Support\Facades\DB;
use Illuminate\Database\Eloquent\Builder;
use Spatie\Activitylog\LogOptions;
use Spatie\Activitylog\Traits\LogsActivity;

class Chapter extends Model
{
    use HasFactory , SoftDeletes , CascadeSoftDeletes , Sluggable , Searchable , LogsActivity;

    public $appends = [
        'episode_count' , 'episode_title_list' , 'minutes' , 'has_transcript'
    ];

    protected $cascadeDeletes = ['comments' , 'transcripts'];

    protected $searchAbleColumns = ['title','slug'];

    protected $guarded = ['id'];

    public function sluggable(): array
    {
        return [
            'slug' => [
                'source' => 'title'
            ]
        ];
    }

    public function getActivitylogOptions(): LogOptions
    {
        return LogOptions::defaults();
    }

    public function scopeFindSimilarSlugs(Builder $query, string $attribute, array $config, string $slug): Builder
    {
        $separator = $config['separator'];

        return $query->where(function(Builder $q) use ($attribute, $slug, $separator) {
            $q->where($attribute, '=', $slug)
                ->orWhere($attribute, 'LIKE', $slug . $separator . '%');
        })->withoutGlobalScopes();
    }

    public function episodeCount(): Attribute
    {
        return Attribute::make(
            get: fn() => $this->episodes()->count()
        );
    }

    public function episodeTitleList(): Attribute
    {
        return Attribute::make(
            get: fn() => $this->episodes()->select('title','id','time','free')->orderBy('view')->cursor()->toArray()
        );
    }

    public function getMinutesAttribute(): string
    {
        $medias = $this->episodes()->sum(DB::raw("TIME_TO_SEC(time)"));
        $minutes = floor($medias / 60);
        return sprintf('%02d', $minutes);
    }

    public function episodesTime(): Attribute
    {
        return Attribute::make(
            get: fn() => $this->episodes()->select('time')->orderBy('view')->cursor()->toArray()
        );
    }

    public function course(): BelongsTo
    {
        return $this->belongsTo(Course::class);
    }

    public function episodes(): HasMany
    {
        return $this->hasMany(Episode::class)->orderBy('view');
    }

    public function samples(): HasMany
    {
        return $this->hasMany(Sample::class);
    }

    public function comments(): MorphMany
    {
        return $this->morphMany(Comment::class, 'commentable')->latest('id')->where('status',CommentEnum::CONFIRMED)
            ->with(['childrenRecursive' => function($q) {
                return $q->where('status',CommentEnum::CONFIRMED);
            }])->whereNull('parent_id');
    }

    public function statusLabel(): Attribute
    {
        return Attribute::make(
            get: fn() => in_array($this->status,array_keys(ChapterEnum::getStatus())) ? ChapterEnum::getStatus()[$this->status] : 'نامشخص'
        );
    }

    protected static function booted(): void
    {
        static::addGlobalScope('published', function (Builder $builder) {
            $builder->where('status',ChapterEnum::PUBLISHED);
        });
    }

    public function transcripts(): HasMany
    {
        return $this->hasMany(ChapterTranscript::class);
    }

    public function hasTranscript(): Attribute
    {
        return Attribute::get(function (){
            return $this->transcripts()->where('status',ChapterEnum::TRANSCRIPT_PENDING)->exists();
        });
    }
}
