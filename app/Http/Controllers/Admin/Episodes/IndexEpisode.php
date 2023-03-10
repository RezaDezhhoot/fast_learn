<?php

namespace App\Http\Controllers\Admin\Episodes;

use App\Http\Controllers\BaseComponent;
use App\Repositories\Interfaces\ChapterRepositoryInterface;
use App\Repositories\Interfaces\CourseRepositoryInterface;
use App\Repositories\Interfaces\EpisodeRepositoryInterface;
use Livewire\WithPagination;

class IndexEpisode extends BaseComponent
{
    use WithPagination;
    protected $queryString = ['course' ,'chapter'];

    public ?string $chapter = null , $course = null , $placeholder = 'عنوان درس';

    public function __construct($id = null)
    {
        parent::__construct($id);
        $this->courseRepository = app(CourseRepositoryInterface::class);
        $this->chapterRepository = app(ChapterRepositoryInterface::class);
        $this->episodeRepository = app(EpisodeRepositoryInterface::class);
    }

    public function mount()
    {
        $this->data['course'] = $this->courseRepository->getAll()->pluck('title','id');
        $this->data['chapter'] = $this->chapterRepository->alL()->pluck('title','id');
    }

    public function render()
    {
        $this->authorizing('show_episodes');
        $episodes = $this->episodeRepository->getAllAdmin($this->course , $this->chapter,$this->search,$this->per_page);
        return view('admin.episodes.index-episode',['episodes'=>$episodes])
            ->extends('admin.layouts.admin');
    }
}
