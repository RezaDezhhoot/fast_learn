<?php

namespace App\Models;

use App\Traits\Admin\Searchable;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class BotPlan extends Model
{
    use HasFactory , Searchable;

    public $searchAbleColumns = ['title'];

    protected $guarded = ['id'];
}
