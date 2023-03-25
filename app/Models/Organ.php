<?php

namespace App\Models;

use App\Enums\OrganEnum;
use App\Traits\Admin\Searchable;
use Cviebrock\EloquentSluggable\Sluggable;
use Dyrynda\Database\Support\CascadeSoftDeletes;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Casts\Attribute;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\HasOne;
use Illuminate\Database\Eloquent\SoftDeletes;
use Morilog\Jalali\Jalalian;

/**
 * @property mixed $status
 * @property mixed $created_at
 */
class Organ extends Model
{
    use HasFactory, SoftDeletes, Searchable, Sluggable;

    protected $guarded = ['id'];

    protected array $searchAbleColumns = ['title', 'slug'];

    protected $casts = [
        'is_new' => 'boolean'
    ];

    public $appends = ['status_label','info'];

    public function sluggable(): array
    {
        return [
            'slug' => [
                'source' => 'title'
            ]
        ];
    }

    public function info(): Attribute
    {
        return Attribute::make(
            get: fn() => $this->information ? $this->information->toArray() : null
        );
    }

    public function scopeFindSimilarSlugs(Builder $query, string $attribute, array $config, string $slug): Builder
    {
        $separator = $config['separator'];

        return $query->where(function (Builder $q) use ($attribute, $slug, $separator) {
            $q->where($attribute, '=', $slug)
                ->orWhere($attribute, 'LIKE', $slug . $separator . '%');
        })->withoutGlobalScopes();
    }

    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }

    public function employees(): BelongsToMany
    {
        return $this->belongsToMany(User::class, 'organ_employees')->withPivot(['role']);
    }

    public function information(): HasOne
    {
        return $this->hasOne(OrganInformation::class);
    }

    public function courses(): HasMany
    {
        return $this->hasMany(Course::class);
    }

    public function articles(): HasMany
    {
        return $this->hasMany(Article::class);
    }

    public function users(): HasMany
    {
        return $this->hasMany(User::class);
    }

    public function incomingMethods(): HasMany
    {
        return $this->hasMany(IncomingMethod::class);
    }

    public function teacherCheckouts(): HasMany
    {
        return $this->hasMany(TeacherCheckout::class);
    }

    public function samples(): HasMany
    {
        return $this->hasMany(Sample::class);
    }

    public function orderDetails(): HasMany
    {
        return $this->hasMany(OrderDetail::class);
    }

    public function chapterTranscripts(): HasMany
    {
        return $this->hasMany(ChapterTranscript::class);
    }

    public function episodeTranscripts(): HasMany
    {
        return $this->hasMany(EpisodeTranscript::class);
    }

    public function statusLabel(): Attribute
    {
        return Attribute::make(
            get: fn() => OrganEnum::getStatus()[$this->status]
        );
    }

    public function getDateAttribute(): string
    {
        return Jalalian::forge($this->created_at)->format('%A, %d %B %Y');
    }

    public function scopePublished($q, $published = false)
    {
        return $published ? $q->where('status', OrganEnum::ACTIVE) : $q;
    }

    public function teachers(): BelongsToMany
    {
        return $this->belongsToMany(Teacher::class,'teacher_has_organs');
    }
}
