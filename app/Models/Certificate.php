<?php

namespace App\Models;

use App\Traits\Admin\Searchable;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\SoftDeletes;

/**
 * @method static findOrFail($id)
 * @method static latest(string $string)
 * @method static count()
 */
class Certificate extends Model
{
    use HasFactory , Searchable , SoftDeletes;

    protected $guarded = ['id'];

    protected array $searchAbleColumns = ['name'];

    public function setLogoAttribute($value)
    {
        $this->attributes['logo'] = str_replace(env('APP_URL'), '', $value);
    }

    public function setBgImageAttribute($value)
    {
        $this->attributes['bg_image'] = str_replace(env('APP_URL'), '', $value);
    }

    public function setAutographImageAttribute($value)
    {
        $this->attributes['autograph_image'] = str_replace(env('APP_URL'), '', $value);
    }

    public function setBorderImageAttribute($value)
    {
        $this->attributes['border_image'] = str_replace(env('APP_URL'), '', $value);
    }

    public function users(): HasMany
    {
        return $this->hasMany(UserCertificate::class);
    }

}
