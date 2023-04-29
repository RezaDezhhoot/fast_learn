<?php

namespace App\Models;

use App\Enums\FormEnum;
use Illuminate\Database\Eloquent\Casts\Attribute;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\HasOne;
use Morilog\Jalali\Jalalian;
use Spatie\Activitylog\LogOptions;
use Spatie\Activitylog\Traits\LogsActivity;

class FormAnswer extends Model
{
    use HasFactory , LogsActivity;

    protected $guarded = ['id'];

    public function form(): BelongsTo
    {
        return $this->belongsTo(Form::class);
    }

    public function getActivitylogOptions(): LogOptions
    {
        return LogOptions::defaults();
    }

    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }

    public function formData(): Attribute
    {
        return Attribute::make(
            get: fn($value) => json_decode($value,true),
            set: fn($value) => json_encode($value)
        );
    }

    public function formDetails(): Attribute
    {
        return Attribute::make(
            get: fn($value) => json_decode($value,true),
            set: fn($value) => json_encode($value)
        );
    }

    public function subjectLabel(): Attribute
    {
        return Attribute::make(
            get: fn() => FormEnum::getSubjects()[$this->subject]
        );
    }

    public function getDateAttribute(): string
    {
        return Jalalian::forge($this->created_at)->format('%A, %d %B %Y');
    }

    public function rating(): HasOne
    {
        return $this->hasOne(CourseRating::class);
    }
}
