<?php

namespace App\Models;

use App\Enums\OrderEnum;
use App\Traits\Admin\Searchable;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\MorphMany;
use Illuminate\Database\Eloquent\Relations\MorphOne;
use Illuminate\Database\Eloquent\SoftDeletes;
use Dyrynda\Database\Support\CascadeSoftDeletes;
use Morilog\Jalali\Jalalian;
use Spatie\Activitylog\LogOptions;
use Spatie\Activitylog\Traits\LogsActivity;

/**
 * @property mixed id
 * @property mixed created_at
 * @property mixed details
 * @property mixed $status
 * @method static findOrFail($id)
 * @method static where(array $where)
 * @method static create(array $data)
 * @method static whereBetween(string $string, string[] $array)
 * @method static withCount(string $string)
 */
class Order extends Model
{
    const CHANGE_ID = 897879;
    use HasFactory , Searchable , SoftDeletes , CascadeSoftDeletes , LogsActivity;

    protected array $cascadeDeletes = ['details'];

    protected $guarded = [];
    protected array $searchAbleColumns = ['id'];

    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }

    public function details(): HasMany
    {
        return $this->hasMany(OrderDetail::class);
    }

    public function notes(): HasMany
    {
        return $this->hasMany(OrderNote::class)->orderBy('id','desc');
    }

    public function getTrackingCodeAttribute(): string
    {
        return 'FL-'.($this->id + self::CHANGE_ID);
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

    public function payment(): MorphOne
    {
        return $this->morphOne(Payment::class,'model');
    }

    public function getActivitylogOptions(): LogOptions
    {
        return (new LogOptions())->logAll();
    }
}
