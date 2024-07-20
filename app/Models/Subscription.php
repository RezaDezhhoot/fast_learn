<?php

namespace App\Models;

use App\Enums\SubscriptionEnum;
use App\Traits\Admin\Searchable;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Subscription extends Model
{
    use HasFactory , SoftDeletes , Searchable;

    protected $guarded = ['id'];

    public $searchAbleColumns = ['title'];

    public function scopePublished($q)
    {
        return $q->where('status',SubscriptionEnum::PUBLISHED);
    }

    public function getStatusLabelAttribute()
    {
        return SubscriptionEnum::getStatus()[$this->status] ?? '-';
    }
}
