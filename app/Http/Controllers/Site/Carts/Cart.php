<?php

namespace App\Http\Controllers\Site\Carts;

use App\Http\Controllers\BaseComponent;
use App\Repositories\Interfaces\SettingRepositoryInterface;
use Artesaos\SEOTools\Facades\JsonLd;
use Artesaos\SEOTools\Facades\OpenGraph;
use Artesaos\SEOTools\Facades\SEOMeta;
use Artesaos\SEOTools\Facades\TwitterCard;
use App\Http\Controllers\Cart\Facades\Cart as Carts;

class Cart extends BaseComponent
{
    public function mount(SettingRepositoryInterface $settingRepository)
    {
        SEOMeta::setTitle($settingRepository->getRow('title').' سبد خرید ');
        SEOMeta::setDescription($settingRepository->getRow('seoDescription'));
        SEOMeta::addKeyword($settingRepository->getRow('seoKeyword',[]));
        OpenGraph::setUrl(url()->current());
        OpenGraph::setTitle($settingRepository->getRow('title').' سبد خرید ');
        OpenGraph::setDescription($settingRepository->getRow('seoDescription'));
        TwitterCard::setTitle($settingRepository->getRow('title').' سبد خرید ');
        TwitterCard::setDescription($settingRepository->getRow('seoDescription'));
        JsonLd::setTitle($settingRepository->getRow('title').' سبد خرید ');
        JsonLd::setDescription($settingRepository->getRow('seoDescription'));
        JsonLd::addImage(asset($settingRepository->getRow('logo')));
        $this->page_address = [
            'home' => ['link' => route('home') , 'label' => 'فکور'],
            'cart' => ['link' => '' , 'label' => 'سبد خرید'],
        ];
    }

    public function deleteItem($id)
    {
        Carts::delete($id);
    }

    public function render()
    {
        $cartContent = Carts::content();
        return view('site.carts.cart',['cartContent'=>$cartContent])->extends('site.layouts.site.site');
    }
}
