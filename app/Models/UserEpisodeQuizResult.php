<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class UserEpisodeQuizResult extends Model
{
    use HasFactory;

    protected $guarded = ['id'];

    public function setAnswersAttribute($value): void
    {
        $this->attributes['answers'] = json_encode($value);
    }

    public function getAnswersAttribute($value)
    {
        return json_decode($value , true);
    }

    public function quiz()
    {
        return $this->belongsTo(EpisodeQuiz::class,'episode_quiz_id');
    }
}
