<?php

namespace App\Http\Controllers\Site\Client;

use App\Repositories\Interfaces\SettingRepositoryInterface;
use App\Repositories\Interfaces\UserRepositoryInterface;
use Artesaos\SEOTools\Facades\JsonLd;
use Artesaos\SEOTools\Facades\OpenGraph;
use Artesaos\SEOTools\Facades\SEOMeta;
use Artesaos\SEOTools\Facades\TwitterCard;
use Carbon\Carbon;
use Livewire\Component;

class Certificate extends Component
{
    public $user , $certificate , $hour , $status;
    protected $queryString = ['status'];
    public function mount(SettingRepositoryInterface $settingRepository , UserRepositoryInterface $userRepository , $id)
    {
        $this->user = auth()->user();
        $this->certificate = $userRepository->findCertificate($this->user,$id,$this->status);
        $this->hour = Carbon::make($this->certificate->transcript->created_at ?? now())->diffInHours($this->certificate->transcript->updated_at ?? now());
        $this->hour = $this->hour > 0 ? $this->hour : 10;
        SEOMeta::setTitle($this->certificate->certificate->name);
        SEOMeta::setDescription($settingRepository->getRow('seoDescription'));
        SEOMeta::addKeyword($settingRepository->getRow('seoKeyword',[]));
        OpenGraph::setUrl(url()->current());
        OpenGraph::setTitle($this->certificate->certificate->name);
        OpenGraph::setDescription($settingRepository->getRow('seoDescription'));
        TwitterCard::setTitle($this->certificate->certificate->name);
        TwitterCard::setDescription($settingRepository->getRow('seoDescription'));
        JsonLd::setTitle($this->certificate->certificate->name);
        JsonLd::setDescription($settingRepository->getRow('seoDescription'));
        JsonLd::addImage(asset($settingRepository->getRow('logo')));
    }
    public function render()
    {
        return view('site.client.certificate')->extends('certificate.layouts.certificate');
    }
}
