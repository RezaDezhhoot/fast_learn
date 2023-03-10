<?php

namespace App\Models;

use App\Enums\ChapterEnum;
use App\Traits\Admin\Searchable;
use Illuminate\Database\Eloquent\Casts\Attribute;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

/**
 * @property mixed $status
 */
class ChapterTranscript extends Model
{
    use HasFactory , Searchable;

    protected $guarded = ['id'];

    protected $casts = [
        'is_confirmed' => 'boolean',
    ];

    protected array $searchAbleColumns = ['title'];

    public function course(): BelongsTo
    {
        return $this->belongsTo(Course::class);
    }

    public function statusLabel(): Attribute
    {
        return Attribute::make(
            get: fn() => in_array($this->status,array_keys(ChapterEnum::getTranscriptStatus())) ? ChapterEnum::getTranscriptStatus()[$this->status] : 'نامشخص'
        );
    }

    public function chapter(): BelongsTo
    {
        return $this->belongsTo(Chapter::class);
    }
}
