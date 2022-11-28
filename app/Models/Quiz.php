<?php

namespace App\Models;

use App\Enums\QuizEnum;
use App\Traits\Admin\Searchable;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Casts\Attribute;

/**
 * @method static findOrFail($id)
 * @method static latest(string $string)
 * @method static count()
 * @property mixed $accept_type
 * @property mixed $min_score
 * @property mixed $total_score
 * @property mixed $questions
 */
class Quiz extends Model
{
    use HasFactory , Searchable , SoftDeletes;

    protected $guarded = ['id'];

    protected array $searchAbleColumns = ['name'];

    public function setImageAttribute($value): array|string
    {
        return $this->attributes['image'] = str_replace(env('APP_URL'), '', $value);
    }

    public function certificate()
    {
        return $this->belongsTo(Certificate::class)->withTrashed();
    }

    public function questions(): BelongsToMany
    {
        return $this->belongsToMany(Question::class,'quizzes_has_questions');
    }

    public function questionCount():Attribute
    {
        return Attribute::make(
            get: fn() => $this->questions()->count()
        );
    }

    public function getAcceptLabelAttribute(): string
    {
        return QuizEnum::getType()[$this->accept_type];
    }

    public function getTotalScoreAttribute(): float|int
    {
        return $this->questions->sum('score');
    }

    public function getMinimumScoreAttribute(): float|int
    {
        $total_score = $this->total_score;
        return $this->accept_type == QuizEnum::PERCENT ? $total_score*($this->min_score/100) : $this->min_score;
    }
}
