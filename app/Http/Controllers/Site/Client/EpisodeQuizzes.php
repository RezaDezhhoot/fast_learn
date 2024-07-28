<?php

namespace App\Http\Controllers\Site\Client;

use App\Http\Controllers\BaseComponent;
use Livewire\Component;

class EpisodeQuizzes extends BaseComponent
{
    public function mount()
    {

    }
    public function render()
    {
        return view('site.client.episode-quizzes')->extends('site.layouts.client.client');
    }
}
