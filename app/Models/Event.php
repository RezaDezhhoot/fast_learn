<?php

namespace App\Models;

use App\Enums\EventEnum;
use App\Traits\Admin\Searchable;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

/**
 * @property mixed $status
 * @property mixed $event
 * @property mixed $id
 *@method static latest(string $string)
 */
class Event extends Model
{
    use HasFactory , Searchable;

    protected $guarded = ['id'];

    protected array $searchAbleColumns = ['title'];

    public function user(): \Illuminate\Database\Eloquent\Relations\BelongsTo
    {
        return $this->belongsTo(User::class);
    }

    public function getStatusLabelAttribute(): string
    {
        return EventEnum::getStatus()[$this->status];
    }

    public function getEventLabelAttribute(): string
    {
        return EventEnum::getEvents()[$this->event];
    }

    public function getOrderLabelAttribute(): string
    {
        return EventEnum::getOrderBy()[$this->order_by];
    }

    public function getJobCountAttribute(): int
    {
        return DB::table('jobs')->where('queue',$this->id)->count();
    }

    public function getFailedJobCountAttribute(): int
    {
        return DB::table('failed_jobs')->where('queue',$this->id)->count();
    }
}
