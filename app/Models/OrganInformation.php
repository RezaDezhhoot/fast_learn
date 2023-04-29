<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Casts\Attribute;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Spatie\Activitylog\LogOptions;
use Spatie\Activitylog\Traits\LogsActivity;

class OrganInformation extends Model
{
    use HasFactory , LogsActivity;

    protected $guarded = ['id'];

    protected $table = 'organ_information';

    public function getActivitylogOptions(): LogOptions
    {
        return LogOptions::defaults();
    }

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

    public function logo(): Attribute
    {
        return Attribute::make(
            set: fn($value) => str_replace(env('APP_URL') . '/', '', $value)
        );
    }

    public function image(): Attribute
    {
        return Attribute::make(
            set: fn($value) => str_replace(env('APP_URL') . '/', '', $value)
        );
    }
}
