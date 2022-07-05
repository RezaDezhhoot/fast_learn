<?php

namespace App\Models;

use App\Traits\Admin\Searchable;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

/**
 * @method static findOrFail($id)
 * @method static latest(string $string)
 */
class Tag extends Model
{
    use HasFactory , Searchable;

    protected $table = 'tags';

    protected array $searchAbleColumns = ['name'];

    public function courses()
    {
        return $this->morphedByMany(Course::class, 'taggable');
    }

    public function articles()
    {
        return $this->morphedByMany(Article::class, 'taggable');
    }
}
