<?php

namespace App\Http\Controllers\Site\Episodes;

use App\Http\Controllers\BaseComponent;
use App\Repositories\Interfaces\CategoryRepositoryInterface;
use App\Repositories\Interfaces\CourseRepositoryInterface;
use App\Repositories\Interfaces\EpisodeRepositoryInterface;
use App\Repositories\Interfaces\HomeworkRepositoryInterface;
use App\Repositories\Interfaces\OrderDetailRepositoryInterface;
use App\Repositories\Interfaces\OrderRepositoryInterface;
use App\Repositories\Interfaces\SettingRepositoryInterface;
use App\Rules\ReCaptchaRule;
use Artesaos\SEOTools\Facades\JsonLd;
use Artesaos\SEOTools\Facades\OpenGraph;
use Artesaos\SEOTools\Facades\SEOMeta;
use Artesaos\SEOTools\Facades\TwitterCard;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Log;

class SingleEpisode extends BaseComponent
{
    use AuthorizesRequests;
    public  $course_data , $chapter_data , $episode_data;

    public $chapters , $episodes = [];

    public  $show_homework_form = false ;

    public $user;

    public $api_bucket , $episode_id , $local_video;

    public $recaptcha;


    public function __construct($id = null)
    {
        parent::__construct($id);
        $this->courseRepository = app(CourseRepositoryInterface::class);
        $this->categoryRepository = app(CategoryRepositoryInterface::class);
        $this->settingRepository = app(SettingRepositoryInterface::class);
        $this->episodeRepository = app(EpisodeRepositoryInterface::class);
        $this->orderRepository = app(OrderRepositoryInterface::class);
        $this->orderDetailRepository = app(OrderDetailRepositoryInterface::class);
        $this->homeworkRepository = app(HomeworkRepositoryInterface::class);
    }

    public function mount($course , $chapter , $episode)
    {
        $this->user = auth()->user();
        $this->course_data = $this->courseRepository->get('slug',$course,true);
        $this->loadData($chapter , $episode);
//        if (
//            !$this->episode_data->free && $this->course_data->price > 0 && ( (\auth()->check() && !$this->user->hasCourse($this->course_data->id)) || !\auth()->check()) )
//            abort(404);

        $title = $this->course_data->title.' | '.$this->episode_data->title;
        SEOMeta::setTitle($title);
        SEOMeta::setDescription($this->course_data->seo_description);
        SEOMeta::addKeyword($this->course_data->seo_keywords);
        OpenGraph::setUrl(url()->current());
        OpenGraph::setTitle($title);
        OpenGraph::setDescription($this->course_data->seo_description);
        TwitterCard::setTitle($title);
        TwitterCard::setDescription($this->course_data->seo_description);
        JsonLd::setTitle($title);
        JsonLd::setDescription($this->course_data->seo_description);
        JsonLd::addImage(asset($this->settingRepository->getRow('logo')));

        if (Auth::check() && $this->episode_data->can_homework)
            $this->show_homework_form = $this->user->hasCourse($this->course_data->id);
    }

    public function loadData($chapter , $episode)
    {
        $this->chapter_data = $this->course_data->chapters->where('slug',$chapter)->first();
        $this->episode_data = $this->chapter_data->episodes->where('id',$episode)->first();
    }

    public function loadEpisode($chapter , $episode)
    {
        if (is_numeric($chapter)) {
            $this->chapter_data = $this->course_data->chapters->where('id',$chapter)->first();
        }
        $this->episode_data = $this->chapter_data->episodes->where('id',$episode)->first();

        if (Auth::check() && $this->episode_data->can_homework)
            $this->show_homework_form = $this->user->hasCourse($this->course_data->id);
    }

    public function render()
    {
        return view('site.episodes.single-episode')->extends('site.layouts.site.episode');
    }
}
