<?php

namespace App\Models;

use App\Enums\NotificationEnum;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Morilog\Jalali\Jalalian;

/**
 * @property mixed created_at
 * @property mixed subject
 * @property mixed type
 * @method static findOrFail($id)
 * @method static create(array $data)
 */
class Notification extends Model
{
    use HasFactory;
    protected $guarded = ['id'];

    protected $attributes = [
        'is_read' => false
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function getSubjectLabelAttribute()
    {
        return NotificationEnum::getSubject()[$this->subject];
    }

    public function getTypeLabelAttribute()
    {
        return NotificationEnum::getType()[$this->type];
    }

    public function getDateAttribute()
    {
        return Jalalian::forge($this->created_at)->format('%A, %d %B %Y');
    }
}
