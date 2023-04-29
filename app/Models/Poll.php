<?php

namespace App\Models;

use App\Traits\Admin\Searchable;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Spatie\Activitylog\LogOptions;
use Spatie\Activitylog\Traits\LogsActivity;

class Poll extends Model
{
    use HasFactory , Searchable , LogsActivity;

    public function getActivitylogOptions(): LogOptions
    {
        return LogOptions::defaults();
    }

    protected array $searchAbleColumns = ['title'];

    protected $guarded = ['id'];

    public function items(): HasMany
    {
        return $this->hasMany(PollItem::class);
    }
}
