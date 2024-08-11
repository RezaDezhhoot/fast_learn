<?php

namespace App\Http\Controllers\Site\Client;

use App\Http\Controllers\BaseComponent;
use App\Models\Setting;
use App\Models\WorkshopBot;
use Livewire\Component;

class Workshop extends BaseComponent
{
    public $hasStarted = false;

    public $workshop;

    public function mount()
    {
        $this->workshop = WorkshopBot::query()->where('user_id',auth()->id())->first();
        $this->hasStarted = $this->workshop->status ?? false;
    }

    public function render()
    {
        return view('site.client.workshop');
    }

    public function start()
    {
        if (! WorkshopBot::query()->where('user_id',auth()->id())->where('status',true)->exists()) {
            WorkshopBot::query()->updateOrCreate([
                'user_id' => auth()->id()
            ] , [
                'status' => true,
                'amount' => Setting::getSingleRow('default_work_shop_amount',1)
            ]);
            $this->workshop = WorkshopBot::query()->where('user_id',auth()->id())->first();
            $this->hasStarted = true;
        }
    }
}
