<?php

namespace App\Models;

use App\Enums\ReductionEnum;
use App\Traits\Admin\Searchable;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Spatie\Activitylog\LogOptions;
use Spatie\Activitylog\Traits\LogsActivity;

/**
 * @method static latest(string $string)
 * @method static findOrFail($id)
 * @method static where(array $where)
 * @property mixed $type
 */
class Reduction extends Model
{
    use HasFactory , Searchable , LogsActivity;

    public function getActivitylogOptions(): LogOptions
    {
        return LogOptions::defaults();
    }

    protected array $searchAbleColumns = ['code'];

    public function metas()
    {
        return $this->hasMany(ReductionMeta::class);
    }

    public function getTypeLabelAttribute(): string
    {
        return ReductionEnum::getType()[$this->type];
    }
}
