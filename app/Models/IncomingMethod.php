<?php

namespace App\Models;

use App\Traits\Admin\Searchable;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\SoftDeletes;
use Spatie\Activitylog\LogOptions;
use Spatie\Activitylog\Traits\LogsActivity;

/**
 * @method static latest(string $string)
 * @method static findOrFail($id)
 * @method static find($id)
 */
class IncomingMethod extends Model
{
    use HasFactory , Searchable , SoftDeletes , LogsActivity;

    protected array $searchAbleColumns = [''];

    public function getActivitylogOptions(): LogOptions
    {
        return LogOptions::defaults();
    }


    public function courses(): HasMany
    {
        return $this->hasMany(Course::class);
    }
}
