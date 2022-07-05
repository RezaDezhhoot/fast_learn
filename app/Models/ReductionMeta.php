<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

/**
 * @method static updateOrCreate(array $key, array $value)
 * @method static where(array $conditions)
 */
class ReductionMeta extends Model
{
    use HasFactory;
    protected $guarded = [];
    protected $table = 'reduction_metas';

    public $timestamps = false;
}
