<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Casts\Attribute;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

/**
 * @method static create(array $data)
 */
class NewCourseChat extends Model
{
    use HasFactory;

    protected $guarded = ['id'];

    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }

    public function course(): BelongsTo
    {
        return $this->belongsTo(NewCourse::class);
    }

    public function files(): Attribute
    {
        return  Attribute::make(
            get: fn($value) => !empty($value) ? json_decode($value,true) : [],
            set: fn($value) => json_encode($value)
        );
    }


}
