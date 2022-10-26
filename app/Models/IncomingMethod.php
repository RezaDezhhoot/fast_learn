<?php

namespace App\Models;

use App\Traits\Admin\Searchable;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\SoftDeletes;

/**
 * @method static latest(string $string)
 * @method static findOrFail($id)
 * @method static find($id)
 */
class IncomingMethod extends Model
{
    use HasFactory , Searchable , SoftDeletes;

    protected array $searchAbleColumns = [''];

    public function courses(): HasMany
    {
        return $this->hasMany(Course::class);
    }
}
