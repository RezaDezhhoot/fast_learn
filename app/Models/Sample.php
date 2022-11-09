<?php

namespace App\Models;

use App\Enums\SampleEnum;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Model;
use App\Traits\Admin\Searchable;
use Cviebrock\EloquentSluggable\Sluggable;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

/**
 * @method static latest(string $string)
 * @method static withoutGlobalScope(string $string)
 * @property mixed $course
 * @property mixed $status
 * @property mixed $type
 */
class Sample extends Model
{
    use HasFactory , Searchable  , Sluggable;

    protected $guarded = ['id'];

    protected array $searchAbleColumns = ['title','slug'];

    public function sluggable(): array
    {
        return [
            'slug' => [
                'source' => 'title'
            ]
        ];
    }

    public function course(): BelongsTo
    {
        return $this->belongsTo(Course::class);
    }

    public function getStatusLabelAttribute(): string
    {
        return in_array($this->status , array_keys(SampleEnum::getStatus())) ? SampleEnum::getStatus()[$this->status] : 'نامشخص';
    }

    public function getTypeLabelAttribute(): string
    {
        return in_array($this->type , array_keys(SampleEnum::getType())) ? SampleEnum::getType()[$this->type] : 'نامشخص';
    }

    public function setFileAttribute($value)
    {
        $this->attributes['file'] = str_replace(env('APP_URL').'/storage', '', $value);
    }

    protected static function booted()
    {
        static::addGlobalScope('published', function (Builder $builder) {
            $builder->where('status', SampleEnum::PUBLISHED);
        });
    }
}
