<?php

namespace App\Models;

use App\Enums\CategoryEnum;
use App\Traits\Admin\Searchable;
use Dyrynda\Database\Support\CascadeSoftDeletes;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Cviebrock\EloquentSluggable\Sluggable;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

/**
 * @method static article()
 * @method static course()
 * @method static latest(string $string)
 * @method static question()
 * @method static count()
 * @method static findMany(array $ids)
 * @method static find($id)
 * @property mixed type
 * @property mixed $article_count
 * @property mixed $question_count
 * @property mixed $course_count
 */
class Category extends Model
{
    use HasFactory , Searchable  , Sluggable;

    public function sluggable(): array
    {
        return [
            'slug' => [
                'source' => 'title'
            ]
        ];
    }

    protected $table = 'categories';

    protected $fillable = ['slug','title','parent_id','image','seo_keywords','seo_description','type'];

    protected array $searchAbleColumns = ['slug','title'];

    public function getTypeLabelAttribute(): string
    {
        return CategoryEnum::getTypes()[$this->type];
    }

    public function setImageAttribute($value)
    {
        $this->attributes['image'] = str_replace(env('APP_URL'), '', $value);
    }

    public function child(): HasMany
    {
        return $this->hasMany($this,'parent_id');
    }

    public function parent(): BelongsTo
    {
        return $this->belongsTo($this,'parent_id');
    }

    public function getCourseCountAttribute(): int
    {
        return $this->courses()->count();
    }

    public function getArticleCountAttribute(): int
    {
        return $this->articles()->count();
    }

    public function getQuestionCountAttribute(): int
    {
        return $this->questions()->count();
    }

    public function getDataTypeAttribute(): array
    {
        return match ($this->type) {
            CategoryEnum::ARTICLE => ['label' => 'مقاله' , 'count' => $this->article_count , 'route' => 'articles' ],
            CategoryEnum::QUESTION => ['label' => 'سوال' , 'count' => $this->question_count , 'route' => '' ],
            default => ['label' => 'دوره' , 'count' => $this->course_count , 'route' => 'courses' ],
        };
    }

    public function childrenRecursive(): HasMany
    {
        return $this->child()->with('childrenRecursive');
    }

    public function courses(): HasMany
    {
        return $this->hasMany(Course::class);
    }

    public function articles(): HasMany
    {
        return $this->hasMany(Article::class);
    }

    public function questions(): HasMany
    {
        return $this->hasMany(Question::class);
    }

    public function scopeArticle($query)
    {
        return $query->where('type',CategoryEnum::ARTICLE);
    }

    public function scopeCourse($query)
    {
        return $query->where('type',CategoryEnum::COURSE);
    }

    public function scopeQuestion($query)
    {
        return $query->where('type',CategoryEnum::QUESTION);
    }
}
