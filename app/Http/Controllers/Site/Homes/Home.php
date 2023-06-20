<?php

namespace App\Http\Controllers\Site\Homes;

use App\Http\Controllers\BaseComponent;
use App\Repositories\Interfaces\CertificateRepositoryInterface;
use App\Repositories\Interfaces\CourseRepositoryInterface;
use App\Repositories\Interfaces\QuizRepositoryInterface;
use App\Repositories\Interfaces\SettingRepositoryInterface;
use App\Repositories\Interfaces\TeacherRepositoryInterface;
use App\Repositories\Interfaces\UserRepositoryInterface;
use Artesaos\SEOTools\Facades\JsonLd;
use Artesaos\SEOTools\Facades\OpenGraph;
use Artesaos\SEOTools\Facades\SEOMeta;
use Artesaos\SEOTools\Facades\TwitterCard;

class Home extends BaseComponent
{
    public  $content , $starter = [] , $box = [] , $raw_content;

    public function __construct($id = null)
    {
        parent::__construct($id);
        $this->settingRepository = app(SettingRepositoryInterface::class);
    }

    public function mount
    (
        UserRepositoryInterface $userRepository ,
        CertificateRepositoryInterface $certificateRepository ,
        TeacherRepositoryInterface $teacherRepository ,
        QuizRepositoryInterface $quizRepository
    )
    {
        SEOMeta::setTitle($this->settingRepository->getRow('title'));
        SEOMeta::setDescription($this->settingRepository->getRow('seoDescription'));
        SEOMeta::addKeyword($this->settingRepository->getRow('seoKeyword',[]));
        OpenGraph::setUrl(url()->current());
        OpenGraph::setTitle($this->settingRepository->getRow('title'));
        OpenGraph::setDescription($this->settingRepository->getRow('seoDescription'));
        TwitterCard::setTitle($this->settingRepository->getRow('title'));
        TwitterCard::setDescription($this->settingRepository->getRow('seoDescription'));
        JsonLd::setTitle($this->settingRepository->getRow('title'));
        JsonLd::setDescription($this->settingRepository->getRow('seoDescription'));
        JsonLd::addImage(asset($this->settingRepository->getRow('logo')));
        $this->raw_content = $this->settingRepository->getRow('homeContent',[]);
        $this->box = $this->settingRepository->getRow('homeBox',[]);
        $send = [];

        foreach ($this->raw_content as $key => $value)
        {
            if ($value['category'] <> 'banners')
            {
                $model = $this->settingRepository::models()[$value['category']];
                $send[$key] = $value;
                $send[$key]['content'] = $model::findMany($value['contentCase']);
                $send[$key]['content']->each(function($model) use ($value) {
                    switch ($value['category']) {
                        case 'courses':
                            $model->setAppends(['status_label','reduction_percent','hours','price','base_price','has_reduction','type_label','sold_count','score']);
                            if (!is_null($model->teacher))
                                $value['teacher'] = $model->teacher->toArray();
                            break;
                        case 'articles':
                            $model->setAppends(['updated_date','comments_count']);
                            $value['user'] = $model->user->toArray();
                            break;
                    }
                    if ($model->category)
                        $value['category'] = $model->category->toArray();
                });
            } else
                $send[$key] = $value;
        }
        $this->content = array_values(collect($send)->sortBy('view')->toArray());

        $this->starter = [
            'users' => $userRepository->count(),
            'teachers' => $teacherRepository->count(),
            'quizzes' => $quizRepository->count(),
            'certificates' => $certificateRepository->count()
        ];
    }

    public function loadOthers()
    {

    }

    public function render()
    {
        return view('site.homes.home')->extends('site.layouts.site.site');
    }
}
