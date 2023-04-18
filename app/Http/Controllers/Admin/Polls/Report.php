<?php

namespace App\Http\Controllers\Admin\Polls;

use App\Http\Controllers\BaseComponent;
use App\Models\Poll;

class Report extends BaseComponent
{
    public $header , $poll;

    public function mount($id)
    {
        $this->authorizing('show_forms');
        $this->poll = Poll::query()->with(['items','items.items','items.items.choose'])->findOrFail($id);
        $this->header = $this->poll->title;
    }

    public function loadData()
    {
        $data = [];

        foreach ($this->poll->items as $item) {
            foreach ($item->items as $value) {
                $data[$item->id]['x'][] = $value->title;
                $data[$item->id]['y'][] = $value->choose->count() ?? 0;
            }

        }
        $this->emit('loadChart',$data);
    }

    public function render()
    {
        return view('admin.polls.report')->extends('admin.layouts.admin');
    }
}
