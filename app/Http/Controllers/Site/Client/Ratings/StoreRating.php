<?php

namespace App\Http\Controllers\Site\Client\Ratings;

use App\Http\Controllers\BaseComponent;
use App\Models\UserPoll;
use App\Repositories\Interfaces\CourseRepositoryInterface;
use App\Repositories\Interfaces\SettingRepositoryInterface;
use Artesaos\SEOTools\Facades\JsonLd;
use Artesaos\SEOTools\Facades\OpenGraph;
use Artesaos\SEOTools\Facades\SEOMeta;
use Artesaos\SEOTools\Facades\TwitterCard;

class StoreRating extends BaseComponent
{
    public $course  , $poll , $answers = [];
    public function __construct($id = null)
    {
        parent::__construct($id);
        $this->courseRepository = app(CourseRepositoryInterface::class);
    }

    public function mount($id , SettingRepositoryInterface $settingRepository)
    {
        $this->course =  $courses = collect(auth()->user()->orderDetails)->where('course_id',$id)->first()->course;
        abort_if(
            ! $this->course ||
            ! $this->course->form ||
            collect(auth()->user()->ratings)->where('course_id', $this->course->id)->first()
            ,404);

        SEOMeta::setTitle($settingRepository->getRow('title').'-'.'  نظر سنجی');
        SEOMeta::setDescription($settingRepository->getRow('seoDescription'));
        SEOMeta::addKeyword($settingRepository->getRow('seoKeyword',[]));
        OpenGraph::setUrl(url()->current());
        OpenGraph::setTitle($settingRepository->getRow('title').'-'.'نظر سنجی');
        OpenGraph::setDescription($settingRepository->getRow('seoDescription'));
        TwitterCard::setTitle($settingRepository->getRow('title').'-'.'نظر سنجی');
        TwitterCard::setDescription($settingRepository->getRow('seoDescription'));
        JsonLd::setTitle($settingRepository->getRow('title').'-'.' نظر سنجی');
        JsonLd::setDescription($settingRepository->getRow('seoDescription'));
        JsonLd::addImage(asset($settingRepository->getRow('logo')));

        $this->poll = $this->course->form;
        $this->poll->load('items');
        $this->poll->load('items.items');
    }

    public function store()
    {
        if (! collect(auth()->user()->ratings)->where('course_id', $this->course->id)->first()) {
            $this->resetErrorBag();
            foreach ($this->poll->items as $key => $poll) {
                if (!isset($this->answers[$poll['id']]) || empty($this->answers[$poll['id']])) {
                    $this->addError('answers.' . $key . '.error', __('validation.required', ['attribute' => '']));
                    return;
                }
            }

            foreach ($this->answers as $key => $answer) {
                UserPoll::query()->create([
                    'poll_item_choice_id' => $answer,
                    'user_id' => auth()->id(),
                    'course_id' => $this->course->id
                ]);
            }

            $this->emitNotify('اطلاعات با موفقیت ذحیره شد');
            redirect()->route('user.courses');
        }
    }

    public function render()
    {
        return view('site.client.ratings.store-rating')
            ->extends('site.layouts.client.client');
    }
}
