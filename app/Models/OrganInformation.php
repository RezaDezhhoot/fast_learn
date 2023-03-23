<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Casts\Attribute;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class OrganInformation extends Model
{
    use HasFactory;

    protected $guarded = ['id'];

    protected $table = 'organ_information';

    public function organ(): BelongsTo
    {
        return $this->belongsTo(Organ::class);
    }

    public function transcript(): Attribute
    {
        return Attribute::make(
            get: fn($value) => json_decode($value,true),
            set: fn($value) => json_encode($value)
        );
    }
}
