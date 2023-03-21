<?php

namespace App\Models;

use App\Enums\CommentEnum;
use App\Enums\CourseEnum;
use App\Enums\OrderEnum;
use App\Enums\ReductionEnum;
use App\Traits\Admin\Searchable;
use Carbon\Carbon;
use Cviebrock\EloquentSluggable\Sluggable;
use Dyrynda\Database\Support\CascadeSoftDeletes;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\HasManyThrough;
use Illuminate\Database\Eloquent\Relations\MorphMany;
use Illuminate\Database\Eloquent\Relations\MorphToMany;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Support\Facades\DB;
use Morilog\Jalali\Jalalian;
use Illuminate\Database\Eloquent\Casts\Attribute;

/**
 * @property mixed reduction_value
 * @property mixed has_reduction
 * @property mixed base_price
 * @property mixed reduction_type
 * @property mixed price
 * @property mixed status
 * @property mixed $const_price
 * @property mixed $sold_count
 * @property mixed $updated_at
 * @property mixed $id
 * @property mixed $level
 * @method static latest(string $string)
 * @method static findOrFail($id)
 * @method static published()
 * @method static when(mixed $type, \Closure $param)
 * @method static where($col, $value)
 * @method static whereIn($col, array $value)
 * @method static count()
 * @method static select(string[] $array)
 * @method static whereHas(string $string, \Closure $param)
 */
class Course extends Model
{
    use HasFactory , Searchable , Sluggable , SoftDeletes , CascadeSoftDeletes;

    protected $cascadeDeletes = ['comments','chapters','tags'];

    protected $guarded = ['id'];

    protected array $searchAbleColumns = ['title','slug','short_body'];

    public $appends = ['short_code'];

    public function scopePublished($query)
    {
        return $query->where('status','!=',CourseEnum::DRAFT);
    }

    public function sluggable(): array
    {
        return [
            'slug' => [
                'source' => 'title'
            ]
        ];
    }

    public function scopeFindSimilarSlugs(Builder $query, string $attribute, array $config, string $slug): Builder
    {
        $separator = $config['separator'];

        return $query->where(function(Builder $q) use ($attribute, $slug, $separator) {
            $q->where($attribute, '=', $slug)
                ->orWhere($attribute, 'LIKE', $slug . $separator . '%');
        })->withoutGlobalScopes();
    }

    protected function typeLabel(): Attribute
    {
        return Attribute::make(
            get: fn() => in_array($this->type,array_keys(CourseEnum::getTypes())) ?
                CourseEnum::getTypes()[$this->type] : ''
        );
    }

    public function getTimeAttribute(): string
    {
        $medias = $this->episodes()->sum(DB::raw("TIME_TO_SEC(time)"));
        $hours = floor($medias / 3600);
        $minutes = floor($medias / 60 % 60);
        $secs = 0;
        return sprintf('%02d:%02d:%02d', $hours, $minutes, $secs);
    }

    public function getHoursAttribute(): string
    {
        $medias = $this->episodes()->sum(DB::raw("TIME_TO_SEC(time)"));
        $hours = floor($medias / 3600);
        return sprintf('%02d', $hours);
    }


    public function setImageAttribute($value)
    {
        $this->attributes['image'] = str_replace(env('APP_URL'), '', $value);
    }

    public function getCanCustomizeAttribute(): bool
    {
        return empty($this->const_price);
    }

    public function getBasePriceAttribute()
    {
        return $this->const_price;
    }

    public function getHasReductionAttribute(): bool
    {
        $reduction =  $this->reduction_value;
        $now = Carbon::now();
        $start = $this->start_at ?? null;
        $end = $this->expire_at ?? null;
        if ($reduction > 0 && in_array($this->reduction_type , [ReductionEnum::PERCENT,ReductionEnum::AMOUNT])){
            if($start == null && $end == null){
                return true;
            } elseif ($start <> null && $end == null) {
                $startDiff = $now->diff(Carbon::make($start));
                return !($startDiff->format('%r%h') > 0);
            } elseif ($start == null && $end <> null) {
                $endDiff = $now->diff(Carbon::make($end));
                return !($endDiff->format('%r%h') <= 0);
            } elseif ($start <> null && $end <> null) {
                $startDiff = $now->diff(Carbon::make($start));
                $endDiff = $now->diff(Carbon::make($end));
                return $startDiff->format('%r%h') <= 0 && $endDiff->format('%r%h') >= 0;
            }
        } return false;
    }

    public function getPriceAttribute()
    {
        $price = $this->base_price;
        if ($this->has_reduction)
            $price = $this->calculateReduction($price , $this->reduction_type , $this->reduction_value);

        return max($price, 0);
    }

    public function calculateReduction($price , $type , $reduction_value): float|int
    {
        return match ($type) {
            ReductionEnum::PERCENT => $price - $price * ($reduction_value / 100),
            ReductionEnum::AMOUNT => $price - $reduction_value,
        };
    }

    public function getReductionAmountAttribute()
    {
        return $this->base_price - $this->price;
    }

    public function getExpireAtAttribute($value): ?Carbon
    {
        return  Carbon::make($value);
    }

    public function getReductionPercentAttribute(): float|int
    {
        return $this->base_price > 0 ? round((($this->base_price - $this->price)/$this->base_price)*100) : 0;
    }

    public function getStatusLabelAttribute(): string
    {
        return in_array($this->status , array_keys(CourseEnum::getStatus())) ? CourseEnum::getStatus()[$this->status] : 'نامشخص';
    }

    public function getLevelLabelAttribute(): string
    {
        return in_array($this->level , array_keys(CourseEnum::getLevels())) ? CourseEnum::getLevels()[$this->level] : 'نامشخص';
    }

    public function category(): BelongsTo
    {
        return $this->belongsTo(Category::class);
    }

    public function teacher(): BelongsTo
    {
        return $this->belongsTo(Teacher::class);
    }

    public function quiz(): BelongsTo
    {
        return $this->belongsTo(Quiz::class,'quiz_id');
    }

    public function episodes(): HasManyThrough
    {
        return $this->hasManyThrough(Episode::class,Chapter::class)->orderBy('view');
    }

    public function chapters(): HasMany
    {
        return $this->hasMany(Chapter::class)->orderBy('view');
    }

    public function transcripts(): HasMany
    {
        return $this->hasMany(Transcript::class);
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

    public function getSoldCountAttribute(): int
    {
        return $this->details()->where('status',OrderEnum::STATUS_COMPLETED())->count();
    }

    public function getShortCodeAttribute(): string
    {
        return base64_encode($this->id);
    }

    public function getUpdatedDateAttribute(): string
    {
        return Jalalian::forge($this->updated_at)->format('%A, %d %B %Y');
    }

    public function getScoreAttribute(): int
    {
        $sold_count = $this->sold_count;
        if ($sold_count >= 500)
            return 5;
        elseif ($sold_count > 300)
            return 4;
        elseif ($sold_count >150)
            return 3;
        elseif ($sold_count > 100)
            return 2;
        elseif ($sold_count > 10)
            return 1;

        return 0;
    }

    public function details(): HasMany
    {
        return $this->hasMany(OrderDetail::class);
    }

    public function scopeHasCategory($query)
    {
        return $query->whereNotNull('category_id');
    }

    public function samples(): HasMany
    {
        return $this->hasMany(Sample::class);
    }

    public function incoming_method(): BelongsTo
    {
        return $this->belongsTo(IncomingMethod::class);
    }

    public function rollCalls(): HasManyThrough
    {
        return $this->hasManyThrough(RollCall::class,OrderDetail::class);
    }

    public function setTimeLapseAttribute($value)
    {
        $this->attributes['time_lapse'] = str_replace(env('APP_URL'), '', $value);
    }
}
