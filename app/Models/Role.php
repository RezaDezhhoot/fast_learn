<?php

namespace App\Models;


use App\Traits\Admin\Searchable;
use Spatie\Activitylog\LogOptions;
use Spatie\Activitylog\Traits\LogsActivity;

/**
 * @method static latest(string $string)
 * @method static whereNotIn(string $string, string[] $array)
 * @method static findOrFail($id)
 */
class Role extends \Spatie\Permission\Models\Role
{
    use Searchable , LogsActivity;
    protected $guarded = [];
    protected static $logAttributes = ['*'];
    protected static $dontLogIfAttributesChangedOnly = ['updated_at'];
    protected static $logOnlyDirty = true;
    protected array $searchAbleColumns = ['name'];

    public function getActivitylogOptions(): LogOptions
    {
        return LogOptions::defaults();
    }
}
