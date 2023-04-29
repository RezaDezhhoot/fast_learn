<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Spatie\Activitylog\LogOptions;
use Spatie\Activitylog\Traits\LogsActivity;

class Wallet extends  \Bavix\Wallet\Models\Wallet
{
    use HasFactory , LogsActivity;
    protected static $logAttributes = ['*'];
    protected static $dontLogIfAttributesChangedOnly = ['updated_at'];
    protected static $logOnlyDirty = true;

    public function getActivitylogOptions(): LogOptions
    {
        return LogOptions::defaults();
    }
}
