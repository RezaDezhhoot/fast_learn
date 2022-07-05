<?php

namespace App\Models;

use App\Enums\QuestionEnum;
use App\Traits\Admin\Searchable;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\Relations\HasMany;

/**
 * @method static findOrFail($id)
 * @method static latest(string $string)
 * @method static findMany(array $ids)
 * @method static find($id)
 * @method static count()
 * @property mixed difficulty
 */
class Question extends Model
{
    use HasFactory , Searchable;

    protected array $searchAbleColumns = ['name'];

    public function quizzes(): BelongsToMany
    {
        return $this->belongsToMany(Quiz::class,'quizzes_has_questions');
    }

    public function choices(): HasMany
    {
        return $this->hasMany(Choice::class,'question_id');
    }

    public function getTrueChoiceAttribute(): Model|HasMany|null
    {
        return $this->choices()->where('is_true',true)->first();
    }

    public function category(): BelongsTo
    {
        return $this->belongsTo(Category::class);
    }

    public function getDifficultyLabelAttribute(): string
    {
        return QuestionEnum::getDifficulty()[$this->difficulty];
    }
}
