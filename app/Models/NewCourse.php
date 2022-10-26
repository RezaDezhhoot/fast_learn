<?php

namespace App\Models;

use App\Enums\CourseEnum;
use App\Traits\Admin\Searchable;
use Illuminate\Database\Eloquent\Casts\Attribute;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Morilog\Jalali\Jalalian;

/**
 * @method static latest(string $string)
 * @method static find($id)
 * @method static findOrFail($id)
 * @method static where(string $string, string $NEW_COURSE_PENDING)
 * @property mixed $status
 * @property mixed $level
 */
class NewCourse extends Model
{
    use HasFactory , Searchable;

    protected $table = 'new_course_requests';

    protected array $searchAbleColumns = ['title'];

    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }

    public function statusLabel(): Attribute
    {
        return  Attribute::make(
            get: fn() => in_array($this->status , array_keys(CourseEnum::getNewCourseStatus())) ? CourseEnum::getNewCourseStatus()[$this->status] : 'نامشخص'
        );
    }

    public function createdAt(): Attribute
    {
        return Attribute::make(
            get: fn($value) => Jalalian::forge($value)->format('%A, %d %B %Y')
        );
    }

    public function levelLabel(): Attribute
    {
        return  Attribute::make(
            get: fn() => in_array($this->level , array_keys(CourseEnum::getLevels())) ? CourseEnum::getLevels()[$this->level] : 'نامشخص'
        );
    }

    public function setFilesAttribute($value)
    {
        $file = [];
        foreach (explode(',',$value) as $item)
            $file[] = str_replace(env('APP_URL'), '', $item);

        $this->attributes['files'] = implode(',',$file);
    }

    public function getFilesAttribute($value)
    {
        if (!empty($value))
            return explode(',',$value);

        return null;
    }

    public function chats(): HasMany
    {
        return $this->hasMany(NewCourseChat::class,'new_course_request_id');
    }
}
