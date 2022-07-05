<?php

namespace App\Models;

use App\Enums\OrderEnum;
use App\Traits\Admin\Searchable;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\SoftDeletes;
use Morilog\Jalali\Jalalian;

/**
 * @property mixed id
 * @property mixed created_at
 * @property mixed details
 * @method static findOrFail($id)
 * @method static where(array $where)
 * @method static create(array $data)
 * @method static whereBetween(string $string, string[] $array)
 */
class Order extends Model
{
    const CHANGE_ID = 897879;
    use HasFactory , Searchable , SoftDeletes;

    protected $guarded = [];
    protected array $searchAbleColumns = ['id'];

    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }

    public function details(): \Illuminate\Database\Eloquent\Relations\HasMany
    {
        return $this->hasMany(OrderDetail::class)->withTrashed();
    }

    public function notes(): \Illuminate\Database\Eloquent\Relations\HasMany
    {
        return $this->hasMany(OrderNote::class)->orderBy('id','desc');
    }

    public function getTrackingCodeAttribute(): string
    {
        return 'KV-'.($this->id + self::CHANGE_ID);
    }

    public function getDateAttribute(): string
    {
        return Jalalian::forge($this->created_at)->format('%A, %d %B %Y');
    }

    public function getStatusAttribute(): string
    {
        $details = $this->details;
        foreach ($details as $detail)
        {
            if ($detail->status == OrderEnum::STATUS_NOT_PAID)
                return $detail->status;

            if ($detail->status == OrderEnum::STATUS_COMPLETED || $detail->status == OrderEnum::STATUS_REFUNDED)
                return $detail->status;
        }

        return OrderEnum::STATUS_PROCESSING;
    }
    public function getStatusLabelAttribute(): string
    {
        return OrderEnum::getStatus()[$this->status];
    }
}
