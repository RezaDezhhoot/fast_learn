<?php

namespace App\Http\Controllers\Site\Client;

use App\Http\Controllers\BaseComponent;
use App\Repositories\Interfaces\SettingRepositoryInterface;
use App\Repositories\Interfaces\UserRepositoryInterface;
use Artesaos\SEOTools\Facades\JsonLd;
use Artesaos\SEOTools\Facades\OpenGraph;
use Artesaos\SEOTools\Facades\SEOMeta;
use Artesaos\SEOTools\Facades\TwitterCard;
use Livewire\Component;

class IntroVideo extends BaseComponent
{
    public function __construct($id = null)
    {
        parent::__construct($id);
        $this->userRepository = app(UserRepositoryInterface::class);
        $this->settingRepository = app(SettingRepositoryInterface::class);
    }

    public function mount(): void
    {
        SEOMeta::setTitle($this->settingRepository->getRow('title').'-'.'ویدئو معرفی');
        SEOMeta::setDescription($this->settingRepository->getRow('seoDescription'));
        SEOMeta::addKeyword($this->settingRepository->getRow('seoKeyword',[]));
        OpenGraph::setUrl(url()->current());
        OpenGraph::setTitle($this->settingRepository->getRow('title').'-'.'ویدئو معرفی');
        OpenGraph::setDescription($this->settingRepository->getRow('seoDescription'));
        TwitterCard::setTitle($this->settingRepository->getRow('title').'-'.'ویدئو معرفی');
        TwitterCard::setDescription($this->settingRepository->getRow('seoDescription'));
        JsonLd::setTitle($this->settingRepository->getRow('title').'-'.'ویدئو معرفی');
        JsonLd::setDescription($this->settingRepository->getRow('seoDescription'));
        JsonLd::addImage(asset($this->settingRepository->getRow('logo')));
    }

    public function initVideo()
    {
        $this->emit('setVideo' , [
            'src' => config('site.intro_video')
        ]);
    }

    public function seenVideo()
    {
        $user = auth()->user();
        $user->has_seen_intro_video = true;
        $this->userRepository->save($user);

        redirect()->intended(route('user.dashboard'));
    }

    public function render()
    {
        return view('site.client.intro-video')->extends('site.layouts.client.client');
    }
}
