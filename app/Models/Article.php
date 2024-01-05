<?php

namespace App\Models;

use App\Enums\ArticleEnum;
use App\Enums\CategoryEnum;
use App\Enums\CommentEnum;
use App\Traits\Admin\Searchable;
use Carbon\Carbon;
use Cviebrock\EloquentSluggable\Sluggable;
use Illuminate\Database\Eloquent\Casts\Attribute;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\MorphMany;
use Illuminate\Database\Eloquent\Relations\MorphToMany;
use Illuminate\Support\Str;
use Morilog\Jalali\Jalalian;
use Spatie\Sitemap\Contracts\Sitemapable;
use Spatie\Sitemap\Tags\Url;

/**
 * @property mixed created_at
 * @property mixed updated_at
 * @property mixed status
 * @property mixed $type
 * @method static latest(string $string)
 * @method static published(bool $active)
 * @method static count()
 */
class Article extends Model implements Sitemapable
{
    protected $guarded = ['id'];

    use HasFactory , Searchable ;

    public function toSitemapTag(): Url | string | array
    {
        return Url::create(route('article', $this->slug))
            ->setLastModificationDate(Carbon::create($this->updated_at))
            ->setChangeFrequency(Url::CHANGE_FREQUENCY_YEARLY)
            ->setPriority(0.1);
    }

    protected array $searchAbleColumns = ['slug','title','body'];

//    public function sluggable(): array
//    {
//        return [
//            'slug' => [
//                'source' => 'title'
//            ]
//        ];
//    }

    public function scopeHasCategory($query)
    {
        return $query->whereNotNull('category_id');
    }

    public function setImageAttribute($value)
    {
        $this->attributes['image'] = str_replace(env('APP_URL'), '', $value);
    }

        public function setFileAttribute($value)
    {
        $this->attributes['file'] = str_replace(env('APP_URL').'/storage', '', $value);
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

    public function comments(): MorphMany
    {
        return $this->morphMany(Comment::class, 'commentable')->latest('id')->where('status',CommentEnum::CONFIRMED)
            ->with(['childrenRecursive' => function($q) {
                return $q->where('status',CommentEnum::CONFIRMED);
            }])->whereNull('parent_id');
    }

    public function typeLabel(): Attribute
    {
        return  Attribute::make(
            get: fn() => ArticleEnum::getType()[$this->type]
        );
    }
}
