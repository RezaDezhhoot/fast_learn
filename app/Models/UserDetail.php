<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

/**
 * @method static updateOrCreate(array $key, array $value)
 */
class UserDetail extends Model
{
    use HasFactory;

    protected $guarded =['id'];

    public function user(): \Illuminate\Database\Eloquent\Relations\BelongsTo
    {
        return $this->belongsTo(User::class);
    }

    public function getProvinceLabelAttribute(): string
    {
        return !empty($this->province) ? Setting::getProvince()[$this->province] : '';
    }

    public function getCityLabelAttribute(): string
    {
        return (!empty($this->province) && !empty($this->city)) ? Setting::getCity()[$this->province][$this->city] : '';
    }

    public function organ(): \Illuminate\Database\Eloquent\Relations\BelongsTo
    {
        return $this->belongsTo(Organization::class,'organization');
    }
}
