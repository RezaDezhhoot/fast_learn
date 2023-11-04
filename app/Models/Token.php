<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Casts\Attribute;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Hash;

class Token extends Model
{
    use HasFactory;

    protected $guarded = ['id'];

    public function value(): Attribute
    {
        return Attribute::set(
            function ($value) {
                return Hash::make($value);
            }
        );
    }
}
