<?php

namespace App\Models;

use App\Traits\Admin\Searchable;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Poll extends Model
{
    use HasFactory , Searchable;

    protected array $searchAbleColumns = ['title'];

    protected $guarded = ['id'];

    public function items(): HasMany
    {
        return $this->hasMany(PollItem::class);
    }
}
