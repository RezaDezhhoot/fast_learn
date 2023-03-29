<?php

namespace App\Models;

use App\Enums\EventEnum;
use App\Traits\Admin\Searchable;
use Illuminate\Database\Eloquent\Casts\Attribute;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

/**
 * @property mixed $status
 * @property mixed $event
 * @property mixed $id
 * @property mixed $course_id
 * @property mixed $category
 * @property mixed $body
 * @property mixed $course
 * @property mixed $organ_id
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

    public function course()
    {
        return $this->belongsTo(Course::class)->withTrashed();
    }

    public function organ()
    {
        return $this->belongsTo(Organ::class)->withTrashed();
    }

    public function categoryLabel(): Attribute
    {
        return Attribute::make(
            get: fn() => EventEnum::getTargets()[$this->category]
        );
    }

    public function body(): Attribute
    {
        return  Attribute::make(
            set: fn($value) => nl2br($value)
        );
    }

    public static function getParams()
    {
        return [
            EventEnum::TARGET_USERS => [
                '{user_name}' => 'نام کاربر',
            ],
            EventEnum::TARGET_TEACHERS => [
                '{teacher_name}' => 'نام مدرس',
            ],
            EventEnum::TARGET_COURSES => [
                '{user_name}' => 'نام کاربر',
                '{course_title}' => 'عنوان دوره',
                '{course_price}' => 'هزینه دوره',
                '{course_id}' => 'کد دوره',
            ],
            EventEnum::TARGET_ORGANS => [
                '{user_name}' => 'نام کاربر',
                '{organ_title}' => 'عنوان اموزشگاه'
            ]
        ];
    }
}
