<?php

namespace App\Http\Controllers\Admin\Polls;

use App\Http\Controllers\BaseComponent;
use App\Models\Poll;

class IndexPoll extends BaseComponent
{
    public  $placeholder = 'عنوان';
    public function mount()
    {
        $this->authorizing('show_forms');
    }

    public function delete($id)
    {
        $this->authorizing('delete_forms');
        Poll::destroy($id);
    }

    public function render()
    {
        $items = Poll::query()->latest()->search($this->search)->paginate($this->per_page);
        return view('admin.polls.index-poll',get_defined_vars())->extends('admin.layouts.admin');
    }
}
