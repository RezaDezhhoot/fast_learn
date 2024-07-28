<?php

namespace App\Http\Controllers\Site\Client;

use App\Repositories\Interfaces\SettingRepositoryInterface;
use Artesaos\SEOTools\Facades\JsonLd;
use Artesaos\SEOTools\Facades\OpenGraph;
use Artesaos\SEOTools\Facades\SEOMeta;
use Artesaos\SEOTools\Facades\TwitterCard;
use Livewire\Component;

class Quizzes extends Component
{
    public bool $userDetails = false;
    public mixed $user;

    public function mount(SettingRepositoryInterface $settingRepository)
    {
        $this->user = auth()->user();
        SEOMeta::setTitle($settingRepository->getRow('title').' ازمون های پایان دوره ');
        SEOMeta::setDescription($settingRepository->getRow('seoDescription'));
        SEOMeta::addKeyword($settingRepository->getRow('seoKeyword',[]));
        OpenGraph::setUrl(url()->current());
        OpenGraph::setTitle($settingRepository->getRow('title').' ازمون های پایان دوره ');
        OpenGraph::setDescription($settingRepository->getRow('seoDescription'));
        TwitterCard::setTitle($settingRepository->getRow('title').' ازمون های پایان دوره ');
        TwitterCard::setDescription($settingRepository->getRow('seoDescription'));
        JsonLd::setTitle($settingRepository->getRow('title').' ازمون های پایان دوره ');
        JsonLd::setDescription($settingRepository->getRow('seoDescription'));
        JsonLd::addImage(asset($settingRepository->getRow('logo')));
        $this->userDetails = !empty($this->user->details);
    }

    public function render()
    {
        $transcripts = $this->user->transcripts;
        return view('site.client.quizzes',['transcripts'=>$transcripts])->extends('site.layouts.client.client');
    }
}
