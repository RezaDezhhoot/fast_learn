<?php

namespace App\Models;

use App\Enums\QuizEnum;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasOne;
use Morilog\Jalali\Jalalian;

/**
 * @property mixed result
 * @property mixed created_at
 * @property mixed $updated_at
 * @property mixed $id
 * @method static findOrFail($id)
 * @method static create(array $data)
 * @method static where(array $where)
 * @method static latest(string $string)
 * @method static count()
 */
class Transcript extends Model
{
    use HasFactory;

    protected $guarded = ['id'];

    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }

    public function quiz()
    {
        return $this->belongsTo(Quiz::class)->withTrashed();
    }

    public function course(): BelongsTo
    {
        return $this->belongsTo(Course::class)->withTrashed();
    }

    public function getResultLabelAttribute(): string
    {
        return QuizEnum::getResult()[$this->result];
    }

    public function getDateAttribute(): string
    {
        return Jalalian::forge($this->updated_at)->format('%A, %d %B %Y');
    }

    public function getUpdatedDateAttribute(): string
    {
        return Jalalian::forge($this->updated_at)->format('%Y/%m/%d');
    }

    public function getCreateDateAttribute(): string
    {
        return Jalalian::forge($this->created_at)->format('%Y/%m/%d');
    }

    public function answers()
    {
        return $this->hasMany(UserAnswer::class);
    }

    public function certificate(): HasOne
    {
        return $this->hasOne(UserCertificate::class);
    }

    public function getCourseDataAttribute($value)
    {
        return json_decode($value , true);
    }
}
