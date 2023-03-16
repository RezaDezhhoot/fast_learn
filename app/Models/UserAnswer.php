<?php

namespace App\Models;

use App\Enums\QuestionEnum;
use Illuminate\Database\Eloquent\Casts\Attribute;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class UserAnswer extends Model
{
    use HasFactory;

    protected $guarded = ['id'];

    public $appends = ['type_label'];

    public $timestamps = false;

    public function question(): BelongsTo
    {
        return $this->belongsTo(Question::class);
    }

    public function typeLabel(): Attribute
    {
        return Attribute::make(
            get: fn() => in_array($this->type,array_keys(QuestionEnum::getType())) ?
                QuestionEnum::getType()[$this->type] : QuestionEnum::getType()[QuestionEnum::TEST]
        );
    }
}
