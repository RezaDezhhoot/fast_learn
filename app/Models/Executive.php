<?php

namespace App\Models;

use App\Traits\Admin\Searchable;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\hasManyThrough;
use Illuminate\Database\Eloquent\Relations\belongsToMany;
use Illuminate\Database\Eloquent\SoftDeletes;

class Executive extends Model
{
    use HasFactory , Searchable , SoftDeletes;

    protected array $searchAbleColumns = ['title'];

    public function courses(): belongsToMany
    {
        return $this->belongsToMany(Course::class,'course_executive');
    }

    public function users(): hasManyThrough
    {
        return $this->hasManyThrough(User::class,UserDetail::class,'user_id','id');
    }

    public function setLogoAttribute($value)
    {
        $this->attributes['logo'] = str_replace(env('APP_URL'), '', $value);
    }

    public function scopeParent($query,$value = true)
    {
        return $value ? $query->whereNull('parent_id') : $query;
    }

    public function child(): hasMany
    {
        return $this->hasMany($this,'parent_id');
    }
}
