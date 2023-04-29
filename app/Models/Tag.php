<?php

namespace App\Models;

use App\Traits\Admin\Searchable;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\MorphToMany;
use Spatie\Activitylog\LogOptions;
use Spatie\Activitylog\Traits\LogsActivity;

/**
 * @method static findOrFail($id)
 * @method static latest(string $string)
 */
class Tag extends Model
{
    use HasFactory , Searchable , LogsActivity;

    protected $table = 'tags';

    public function getActivitylogOptions(): LogOptions
    {
        return LogOptions::defaults();
    }

    protected array $searchAbleColumns = ['name'];

    public function courses(): MorphToMany
    {
        return $this->morphedByMany(Course::class, 'taggable');
    }

    public function articles(): MorphToMany
    {
        return $this->morphedByMany(Article::class, 'taggable');
    }
}
