<?php

namespace App\Http\Controllers\Admin\Bot;

use App\Http\Controllers\BaseComponent;
use App\Models\BotPlan;
use Livewire\Component;
use Livewire\WithPagination;

class IndexPlan extends BaseComponent
{
    use WithPagination;

    public $placeholder = 'عنوان';

    public function render()
    {
        $items = BotPlan::query()->latest()
            ->search($this->search)->paginate($this->per_page);

        return view('admin.bot.index-plan' , get_defined_vars()) ->extends('admin.layouts.admin');
    }

    public function deleteItem($id)
    {
        BotPlan::destroy($id);
    }
}
