<?php

namespace App\Http\Controllers\Site\Episodes;

use App\Http\Controllers\BaseComponent;
use App\Repositories\Interfaces\EpisodeRepositoryInterface;
use Livewire\Component;

class Header extends BaseComponent
{
    public $episode_data , $course_data , $has_liked = false;

    public function __construct($id = null)
    {
        parent::__construct($id);
        $this->episodeRepository = app(EpisodeRepositoryInterface::class);
    }

    public function mount($course,$episode)
    {
        $this->episode_data = $episode;
        $this->course_data = $course;
        $this->has_liked = $this->episodeRepository->hasLiked($episode);
    }

    public function like()
    {
        if (! $this->has_liked) {
            $this->episodeRepository->like($this->episode_data);
        } else {
            $this->episodeRepository->unLike($this->episode_data);
        }
        $this->has_liked = $this->episodeRepository->hasLiked($this->episode_data);
    }

    public function render()
    {
        return view('site.episodes.header');
    }
}
