<?php

namespace App\Models;

use App\Enums\StorageEnum;
use App\Traits\Admin\Searchable;
use Illuminate\Database\Eloquent\Casts\Attribute;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletes;

class Storage extends Model
{
    use HasFactory , SoftDeletes , Searchable;

    protected array $searchAbleColumns = ['name'];

    protected $guarded = ['id'];

    public function scopeAvailable($query)
    {
        return $query->where('status',StorageEnum::AVAILABLE);
    }
    
    public function statusLabel(): Attribute
    {
        return Attribute::make(
            get: fn() => in_array($this->status , array_keys(StorageEnum::getStatus())) ? StorageEnum::getStatus()[$this->status] : 'نامشخص'
        );
    }

    public function color(): Attribute
    {
        return Attribute::make(
            get: fn() => in_array($this->status , array_keys(StorageEnum::getStatus())) ? StorageEnum::getColor()[$this->status] : 'نامشخص'
        );
    }

    public function permissionName(): Attribute
    {
        return Attribute::make(
            get: fn() => StorageEnum::PERMISSION_PREFIX."{$this->id}"
        );
    }


    public function key(): Attribute
    {
        return Attribute::make(
            get: fn() => StorageEnum::RELATION_KEY_PREFIX."{$this->id}"
        );
    }


    public function driverLabel(): Attribute
    {
        return Attribute::make(
            get: fn() => in_array($this->driver , array_keys(StorageEnum::getStorages())) ? StorageEnum::getStorages()[$this->driver] : 'نامشخص'
        );
    }

    public function config(): Attribute
    {
        return Attribute::make(
            set: fn($value) => json_encode($value),
            get: fn($value) => json_decode($value,true)
        );
    }

    protected static function booted()
    {
        static::addGlobalScope('available', function (Builder $builder) {
            $builder->where('status', StorageEnum::AVAILABLE);
        });
    }
}
