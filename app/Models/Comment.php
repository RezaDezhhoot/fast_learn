<?php

namespace App\Models;

use App\Enums\CommentEnum;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Casts\Attribute;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\MorphTo;
use Morilog\Jalali\Jalalian;


/**
 * @property mixed commentable_type
 * @property mixed status
 * @property mixed created_at
 * @method static where(string $string, string $NOT_CONFIRMED)
 * @method static confirmed(bool $active)
 * @method static create(array $data)
 */
class Comment extends Model
{
    use HasFactory;

    protected $guarded = ['id'];

    protected $attributes = [
        'status' => CommentEnum::NOT_CONFIRMED,
    ];

    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }

    public function commentable(): MorphTo
    {
        return $this->morphTo();
    }

    public function scopeConfirmed($query , $active)
    {
        return $active ? $query->where('status',CommentEnum::CONFIRMED) : $query;
    }

    public function scopeParent($query , $active)
    {
        return $active ? $query->whereNull('parent_id') : $query;
    }

    public function getStatusLabelAttribute(): string
    {
        return CommentEnum::getStatus()[$this->status];
    }

    public function getForLabelAttribute(): string
    {
        return CommentEnum::getFor()[$this->commentable_type];
    }

    public function getModelAttribute(): string
    {
        return CommentEnum::model()[$this->commentable_type];
    }

    public static function getNew()
    {
        return Comment::where('status',CommentEnum::NOT_CONFIRMED)->count();
    }

    public function child(): HasMany
    {
        return $this->hasMany($this,'parent_id')->orderBy('id','desc');
    }

    public function childrenRecursive(): HasMany
    {
        return $this->child()->with('childrenRecursive');
    }

    public function getDateAttribute(): string
    {
        return Jalalian::forge($this->created_at)->format('%A, %d %B %Y');
    }

    public function parent(): BelongsTo
    {
        return $this->belongsTo($this,'parent_id');
    }

    public function CommentAbleData(): Attribute
    {
        return Attribute::make(
            get: fn($value) => json_decode($value , true),
            set: fn($value) => json_encode($value)
        );
    }
}
