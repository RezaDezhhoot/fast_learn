<?php

namespace App\Models;

use App\Enums\EpisodeQuizType;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\SoftDeletes;

class EpisodeQuiz extends Model
{
    use HasFactory , SoftDeletes;

    protected $guarded = ['id'];

    public function episode(): BelongsTo
    {
        return $this->belongsTo(Episode::class);
    }

    public function questions(): BelongsToMany
    {
        return $this->belongsToMany(Question::class,'episode_quiz_questions');
    }

    public function getTypeLabelAttribute()
    {
        return EpisodeQuizType::getTypes()[$this->type] ?? '';
    }

    public function getTotalScoreAttribute(): float|int
    {
        return $this->questions->sum('score');
    }
}
