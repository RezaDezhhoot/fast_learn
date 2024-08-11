<?php

namespace App\Http\Controllers\Site\Client;

use App\Http\Controllers\BaseComponent;
use App\Models\SchoolBot;

class School extends BaseComponent
{
    public $hasStarted = false;

    public function mount()
    {
        $this->hasStarted = SchoolBot::query()->where('user_id',auth()->id())->exists();
    }

    public function render()
    {
        return view('site.client.school');
    }

    public function start()
    {
        if (! SchoolBot::query()->where('user_id',auth()->id())->exists()) {
            SchoolBot::create([
                'user_id' => auth()->id()
            ]);
            $this->hasStarted = true;
        }
    }
}
