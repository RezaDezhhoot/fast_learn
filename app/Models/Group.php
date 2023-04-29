<?php

namespace App\Models;

use App\Traits\Admin\Searchable;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Spatie\Activitylog\LogOptions;
use Spatie\Activitylog\Traits\LogsActivity;

class Group extends Model
{
    use HasFactory , Searchable , LogsActivity;

    protected array $searchAbleColumns = ['title'];

    protected $guarded = ['id'];

    public function getActivitylogOptions(): LogOptions
    {
        return LogOptions::defaults();
    }

    public function course(): BelongsTo
    {
        return $this->belongsTo(Course::class);
    }

    public function users(): BelongsToMany
    {
        return $this->belongsToMany(User::class,'user_has_groups');
    }
}
