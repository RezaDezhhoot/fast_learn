<?php

namespace App\Http\Controllers\Organ\Episodes;

use App\Http\Controllers\BaseComponent;
use App\Repositories\Interfaces\EpisodeRepositoryInterface;
use App\Repositories\Interfaces\EpisodeTranscriptRepositoryInterface;
use Illuminate\Support\Facades\Auth;
use Livewire\WithPagination;

class IndexEpisode extends BaseComponent
{
    use WithPagination;
    protected $queryString = ['course','status','tab'];

    public $course , $status , $tab , $placeholder = 'عنوان درس' , $result;

    const EPISODES = 'episodes' , TRANSCRIPTS = 'transcripts';

    public function __construct($id = null)
    {
        parent::__construct($id);
        $this->episodeRepository = app(EpisodeRepositoryInterface::class);
        $this->episodeTranscriptRepository = app(EpisodeTranscriptRepositoryInterface::class);
    }

    public function mount()
    {
        if (!isset($this->tab))
            $this->tab = self::EPISODES;

        $this->data['course'] = Auth::user()->organCourses->pluck('title','id');
        $this->data['tab'] = [
            self::EPISODES => ['title'=>'درس ها','icon' => 'flaticon2-open-text-book'],
            self::TRANSCRIPTS => ['title'=>'رو نوشت ها','icon' => 'fas fa-envelope-open-text']
        ];
    }

    public function render()
    {
        $episodes = $this->tab == self::EPISODES ?
            $this->episodeRepository->getAllOrgan($this->course,$this->search,$this->per_page) :
            $this->episodeTranscriptRepository->getAllOrgan($this->search,$this->status,$this->course,$this->per_page);

        return view('organ.episodes.index-episode',get_defined_vars())->extends('organ.layouts.organ');
    }

    public function updatedTab()
    {
        $this->resetPage();
    }

    public function show_details($key)
    {
        $this->reset(['result']);
        $this->result = $this->episodeTranscriptRepository->findOrganEpisode($key)->message;
    }
}
