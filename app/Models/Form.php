<?php

namespace App\Models;

use App\Enums\FormEnum;
use App\Enums\StorageEnum;
use App\Traits\Admin\Searchable;
use Illuminate\Database\Eloquent\Casts\Attribute;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

/**
 * @property mixed $subject
 * @property mixed $storage
 */
class Form extends Model
{
    use HasFactory , Searchable;

    protected array $searchAbleColumns = ['name'];

    public function answers(): HasMany
    {
        return $this->hasMany(FormAnswer::class);
    }

    public function typeLabel(): Attribute
    {
        return Attribute::make(
            get: fn() => FormEnum::getSubjects()[$this->subject]
        );
    }

    public function forms(): Attribute
    {
        return Attribute::make(
            get: fn($value) => json_decode($value,true),
            set: fn($value) => json_encode($value)
        );
    }

    public function scopePublished($q , $published)
    {
        return $published ? $q->where('status',FormEnum::PUBLISHED) : $q;
    }

    public function defaultStorage(): Attribute
    {
        return Attribute::make(
            get:fn() => !is_null($this->storage) ? $this->storage : StorageEnum::PRIVATE
        );
    }
}
