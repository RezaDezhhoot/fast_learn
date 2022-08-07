<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Support\Facades\Crypt;

class UserCertificate extends Model
{
    use HasFactory;

    protected $guarded = ['id'];

    protected $table = 'users_certificates';

    public $timestamps = false;

    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }

    public function certificate()
    {
        return $this->belongsTo(Certificate::class)->withTrashed();
    }

    public function transcript()
    {
        return $this->belongsTo(Transcript::class);
    }

    public function getIdAttribute($value)
    {
        return Crypt::encryptString($value);
    }
}
