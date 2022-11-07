<?php

namespace App\Models;

use App\Enums\BankAccountEnum;
use App\Traits\Admin\Searchable;
use Illuminate\Database\Eloquent\Casts\Attribute;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Morilog\Jalali\Jalalian;

/**
 * @method static latest(string $string)
 * @method static where(array $where)
 * @property mixed $status
 */
class BankAccount extends Model
{
    use HasFactory  , Searchable;

    protected array $searchAbleColumns = ['title'];

    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }

    public function scopeActive($q)
    {
        return $q->where('status',BankAccountEnum::AVAILABLE);
    }

    public function statusLabel(): Attribute
    {
        return Attribute::make(
            get: fn() => in_array($this->status,array_keys(BankAccountEnum::getStatus())) ? BankAccountEnum::getStatus()[$this->status] : 'نامشخص'
        );
    }

    public function createdAt(): Attribute
    {
        return Attribute::make(
            get: fn($value) => Jalalian::forge($value)->format('%A, %d %B %Y')
        );
    }
}
