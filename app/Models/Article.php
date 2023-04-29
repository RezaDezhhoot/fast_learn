<?php

namespace App\Models;

use App\Enums\ArticleEnum;
use App\Enums\CategoryEnum;
use App\Enums\CommentEnum;
use App\Traits\Admin\Searchable;
use Cviebrock\EloquentSluggable\Sluggable;
use Illuminate\Database\Eloquent\Casts\Attribute;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\MorphMany;
use Illuminate\Database\Eloquent\Relations\MorphToMany;
use Illuminate\Support\Str;
use Morilog\Jalali\Jalalian;
use Spatie\Activitylog\LogOptions;
use Spatie\Activitylog\Traits\LogsActivity;

/**
 * @property mixed created_at
 * @property mixed updated_at
 * @property mixed status
 * @method static latest(string $string)
 * @method static published(bool $active)
 * @method static count()
 */
class Article extends Model
{
    protected $guarded = ['id'];

    use HasFactory , Searchable , Sluggable , LogsActivity;

    protected array $searchAbleColumns = ['slug','title','body'];

    public function sluggable(): array
    {
        return [
            'slug' => [
                'source' => 'title'
            ]
        ];
    }

    public function scopeHasCategory($query)
    {
        return $query->whereNotNull('category_id');
    }

    public function getStatusLabelAttribute(): string
    {
        return ArticleEnum::getStatus()[$this->status];
    }

    public function category(): BelongsTo
    {
        return $this->belongsTo(Category::class);
    }

    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }

    public function scopePublished($query , $active = true)
    {
        return $active ? $query->where('status',ArticleEnum::PUBLISHED) : $query;
    }

    public function getUpdatedDateAttribute(): string
    {
        return Jalalian::forge($this->updated_at)->format('%A, %d %B %Y');
    }

    public function tags(): MorphToMany
    {
        return $this->morphToMany(Tag::class, 'taggable');
    }

    public function commentsCount(): Attribute
    {
        return Attribute::make(
            get: fn() => $this->comments()->count()
        );
    }

    public function comments(): MorphMany
    {
        return $this->morphMany(Comment::class, 'commentable')->latest('id')->where('status',CommentEnum::CONFIRMED)
            ->with(['childrenRecursive' => function($q) {
                return $q->where('status',CommentEnum::CONFIRMED);
            }])->whereNull('parent_id');
    }

    public function getActivitylogOptions(): LogOptions
    {
        return LogOptions::defaults();
    }
}
