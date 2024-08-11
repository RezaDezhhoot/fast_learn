<?php

namespace App\Http\Controllers\Site\Client;

use App\Http\Controllers\BaseComponent;
use App\Models\BotPlan;
use App\Models\Setting;
use App\Models\WorkshopBot;
use App\Repositories\Interfaces\SettingRepositoryInterface;
use Artesaos\SEOTools\Facades\JsonLd;
use Artesaos\SEOTools\Facades\OpenGraph;
use Artesaos\SEOTools\Facades\SEOMeta;
use Artesaos\SEOTools\Facades\TwitterCard;
use Livewire\Component;

class UpgradeBot extends BaseComponent
{
    public function mount(SettingRepositoryInterface $settingRepository)
    {
        SEOMeta::setTitle($settingRepository->getRow('title').'آپگرید ربات ');
        SEOMeta::setDescription($settingRepository->getRow('seoDescription'));
        SEOMeta::addKeyword($settingRepository->getRow('seoKeyword',[]));
        OpenGraph::setUrl(url()->current());
        OpenGraph::setTitle($settingRepository->getRow('title').'آپگرید ربات');
        OpenGraph::setDescription($settingRepository->getRow('seoDescription'));
        TwitterCard::setTitle($settingRepository->getRow('title').' آپگرید ربات ');
        TwitterCard::setDescription($settingRepository->getRow('seoDescription'));
        JsonLd::setTitle($settingRepository->getRow('title').' آپگرید ربات ');
        JsonLd::setDescription($settingRepository->getRow('seoDescription'));
        JsonLd::addImage(asset($settingRepository->getRow('logo')));

    }
    public function render()
    {
        $items = BotPlan::query()->latest()->cursor();
        return view('site.client.upgrade-bot' , get_defined_vars())->extends('site.layouts.client.client');
    }

    public function start($id)
    {
        $plan = BotPlan::query()->find($id);
        if ($plan) {
            try {
                if ($plan->amount <= auth()->user()->balance && ! auth()->user()->botPlans()->where('bot_plan_id' , $id)->exists() ) {
                    auth()->user()->botPlans()->attach($plan->id);
                    auth()->user()->withdraw($plan->amount , ['description' => 'خرید پلن ربات']);

                    $workshop = WorkshopBot::query()->where('user_id',auth()->id())->first();
                    if ($workshop) {
                        $workshop->increment('amount',$plan->profit);
                    } else {
                        WorkshopBot::query()->create([
                            'user_id' => auth()->id(),
                            'status' => true,
                            'amount' => $plan->profilt + Setting::getSingleRow('default_work_shop_amount' , 0)
                        ]);
                    }

                    $this->emitNotify('پلن برای شما با موفقیت قعال شد');
                }
            } catch (\Exception $exception) {

            }
        }
    }
}
