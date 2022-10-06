<?php

namespace App\Models;

use App\Enums\TicketEnum;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Morilog\Jalali\Jalalian;

/**
 * @property mixed priority
 * @property mixed created_at
 * @property mixed sender_type
 * @property mixed status
 * @property mixed $subject
 * @property mixed $user
 * @property mixed $priority_label
 * @method static findOrFail($id)
 * @method static latest(string $string)
 * @method static where(string $string, $PENDING)
 */
class Ticket extends Model
{
    use HasFactory;

    protected $guarded = ['id','user_id'];


    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function sender()
    {
        return $this->belongsTo(User::class,'sender_id');
    }

    public function getStatusLabelAttribute()
    {
        return TicketEnum::getStatus()[$this->status];
    }

    public function getSenderTypeLabelAttribute()
    {
        return TicketEnum::getSenderType()[$this->sender_type];
    }

    public function getPriorityLabelAttribute()
    {
        return TicketEnum::getPriority()[$this->priority];
    }

    public function getDateAttribute()
    {
        return Jalalian::forge($this->created_at)->format('%A, %d %B %Y');
    }

    public function setFileAttribute($value)
    {
        $file = [];
        foreach (explode(',',$value) as $item)
            $file[] = str_replace(env('APP_URL'), '', $item);

        $this->attributes['file'] = implode(',',$file);
    }

    public function getFileAttribute($value)
    {
        
        return explode(',',$value);
    }

    public static function getNew()
    {
        return Ticket::where('status',TicketEnum::PENDING)->count();
    }

    public function scopeParent($query , $active)
    {
        return $active ? $query->whereNull('parent_id') : $query;
    }

    public function children(): HasMany
    {
        return $this->hasMany(Ticket::class,'parent_id','id')->orderBy('id','desc');
    }
}
