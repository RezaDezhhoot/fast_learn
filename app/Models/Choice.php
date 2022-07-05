<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

/**
 * @method static updateOrCreate(array $key, array $values)
 * @method static findOrFail($id)
 */
class Choice extends Model
{
    use HasFactory;


    public function question(): BelongsTo
    {
        return $this->belongsTo(Question::class);
    }
}
