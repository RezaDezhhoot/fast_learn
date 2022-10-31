<?php

namespace App\Http\Controllers\Admin\EpisodeTranscripts;

use App\Enums\EpisodeEnum;
use App\Http\Controllers\BaseComponent;
use App\Repositories\Interfaces\CourseRepositoryInterface;
use App\Repositories\Interfaces\EpisodeTranscriptRepositoryInterface;
use Livewire\WithPagination;

class IndexEpisodeTranscript extends BaseComponent
{
    use WithPagination;
    protected $queryString = ['course','status'];

    public $status;

    public ?string $course = null , $placeholder = 'عنوان درس';

    public function __construct($id = null)
    {
        parent::__construct($id);
        $this->episodeTranscriptRepository = app(EpisodeTranscriptRepositoryInterface::class);
        $this->courseRepository = app(CourseRepositoryInterface::class);
    }

    public function mount()
    {
        $this->data['status'] = EpisodeEnum::getStatus();
        $this->data['course'] = $this->courseRepository->getAll()->pluck('title','id')->toArray();
    }

    public function render()
    {
        $this->authorizing('show_episodes');
        $episodes = $this->episodeTranscriptRepository->getAllAdmin($this->search ,$this->status,$this->course,$this->per_page);
        return view('admin.episode-transcripts.index-episode-transcript',['episodes'=>$episodes])
            ->extends('admin.layouts.admin');
    }
}
