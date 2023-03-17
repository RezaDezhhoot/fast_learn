<?php

namespace App\Http\Controllers\Site\Episodes;

use App\Http\Controllers\BaseComponent;
use App\Repositories\Interfaces\EpisodeRepositoryInterface;
use App\Repositories\Interfaces\SettingRepositoryInterface;
use Illuminate\Validation\Rule;
use Livewire\Component;

class Header extends BaseComponent
{
    public $episode_data , $course_data , $has_liked = false , $has_reported = false , $subject , $subjects = [];

    public function __construct($id = null)
    {
        parent::__construct($id);
        $this->episodeRepository = app(EpisodeRepositoryInterface::class);
        $this->settingRepository = app(SettingRepositoryInterface::class);
    }

    public function mount($course,$episode)
    {
        $this->episode_data = $episode;
        $this->course_data = $course;
        $this->has_liked = $this->episodeRepository->hasLiked($episode);
        $this->has_reported = $this->episodeRepository->hasReported($episode);
        $this->subjects = $this->settingRepository->getRow('violations',[]);
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

    public function report()
    {
        $violations = $this->settingRepository->getRow('violations',[]);
        $this->validate([
            'subject' => ['required',Rule::in(array_keys($violations))]
        ],[],[
            'subject' => 'غلت'
        ]);
        if ($this->episodeRepository->submitReport($this->episode_data,$violations[$this->subject])){
            $this->emitNotify('گزارش با موفقیت ثبت شد');
            $this->has_reported = true;
        }
        else
            $this->emitNotify('گزارش شما قبلا ثبت شده است','warning');
    }

    public function render()
    {
        return view('site.episodes.header');
    }
}
