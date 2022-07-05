<?php

namespace App\Http\Controllers\Admin\Settings;

use App\Http\Controllers\BaseComponent;
use App\Repositories\Interfaces\SettingRepositoryInterface;

class HomeSetting extends BaseComponent
{
    public $header , $content = [] , $i = 1 , $titleContent , $title , $type  , $width , $bgImage  , $moreLink , $widthCase;
    public $category , $bannerLink , $bannerImage , $bannerContent , $contentCase = [] ;
    public $titleSlider , $slider , $sliderImage , $sliderLink , $sliders = [] , $modeSlider , $row , $view;

    public function __construct($id = null)
    {
        parent::__construct($id);
        $this->settingRepository = app(SettingRepositoryInterface::class);
    }

    public function mount()
    {
        $this->authorizing('show_settings_home');
        $this->header = 'تنظیمات صفحه اصلی';
        $this->data['type'] = [
            'grid' => 'نمایش شبکه ای',
            'slider' => 'نمایش اسلایدری',
        ];
        $this->data['category'] = [
            'articles' => 'اخبار و مقالات',
            'courses' => 'دوره ها',
            'categories' => 'دسته بندی ها',
            'banners' => 'بنر تبلیغاتی',
        ];
        $this->data['width'] = [
            '1' => '8.33%',
            '2' => '16.66%',
            '3' => '25%',
            '4' => '33.33%',
            '5' => '41.66%',
            '6' => '50%',
            '7' => '58.33%',
            '8' => '66.66%',
            '9' => '75%',
            '10' => '83.33%',
            '11' => '91.66%',
            '12' => '100%',
        ];
        $this->content = collect($this->settingRepository->getRow('homeContent',[]));
        $this->slider = $this->settingRepository->getRow('slider');
        $this->sliderImage = $this->settingRepository->getRow('sliderImage');
        $this->sliderLink = $this->settingRepository->getRow('sliderLink');
    }

    public function addContent($title)
    {
        $this->authorizing('edit_settings_fag');
        if ($title <> 'new')
        {
            $this->titleContent = $this->content[$title]['title'];
            $this->view = $this->content[$title]['view'];
            $this->title = $this->content[$title]['title'];
            $this->moreLink = $this->content[$title]['moreLink'] ?? '';
            $this->category = $this->content[$title]['category'];
            $this->type = $this->content[$title]['type'] ?? '';
            $this->width = $this->content[$title]['width'];
            $this->widthCase = $this->content[$title]['widthCase'] ?? '';

            $this->contentCase = $this->content[$title]['contentCase'] ?? [];
            $this->bannerImage = $this->content[$title]['bannerImage'] ?? '';
            $this->bannerLink = $this->content[$title]['bannerLink'] ?? '';
            $this->bannerContent = $this->content[$title]['bannerContent'] ?? '';
        } else {
            $this->resetContentInput();
            $this->titleContent = 'محتوای جدید';
        }
        $this->mode = $title;
        $this->emitShowModal('content');
    }

    public function addContentCase()
    {
        $this->authorizing('edit_settings_fag');
        $this->contentCase[] = '';
    }

    public function storeContent()
    {
        $this->authorizing('edit_settings_fag');
        if ($this->category != 'banners')
        {
            $fields = [
                'title' => ['required', 'string'],
                'view' => ['required', 'integer'],
                'moreLink' => ['nullable', 'url'],
                'category' => ['required','string' ,'in:'.implode(',',array_keys($this->data['category']))],
                'width' => ['required', 'numeric','in:'.implode(',',array_keys($this->data['width']))],
                'type' => ['required','in:slider,grid'],
                'contentCase.*'=> ['required','numeric','exists:'.$this->category.',id'],
            ];
            $messages = [
                'title' => 'عنوان',
                'view' => 'شماره نمایش',
                'width' => 'عرض',
                'category' => 'نوع محتوا',
                'type' => 'نوع نمایش',
                'widthCase' => 'عرض هر باکس',
                'moreLink' => 'لینک صفحه نمایش همه',
                'contentCase.*' => 'موارد'
            ];
            if ($this->type <> 'slider'){
                $fields['widthCase'] = ['required', 'numeric','in:'.implode(',',array_keys($this->data['width']))];
            }
            $this->validate($fields,[], $messages);
            $content = [
                'title' => $this->title,
                'view' => $this->view,
                'width' => $this->width,
                'category' => $this->category,
                'type' => $this->type,
                'widthCase' => $this->widthCase,
                'moreLink' => $this->moreLink,
                'contentCase' => $this->contentCase
            ];
        } else {
            $fields = [
                'title' => ['required', 'string'],
                'view' => ['required', 'integer'],
                'bannerContent' => ['required','string','max:1000'],
                'category' => ['required','string' ,'in:banners'],
                'width' => ['required', 'numeric','in:'.implode(',',array_keys($this->data['width']))],
                'bannerImage' => ['required', 'string'],
                'bannerLink' => ['nullable','url'],
            ];
            $messages = [
                'title' => 'عنوان',
                'view' => 'شماره نمایش',
                'width' => 'عرض',
                'category' => 'نوع محتوا',
                'bannerImage' => 'تسویر',
                'bannerLink' => 'لینک مورد نظر',
                'bannerContent' => 'متن'
            ];

            $this->validate($fields,[], $messages);
            $content = [
                'title' => $this->title,
                'view' => $this->view,
                'width' => $this->width,
                'type' => 'grid',
                'category' => $this->category,
                'bannerImage' => $this->bannerImage,
                'bannerLink' => $this->bannerLink,
                'bannerContent' => $this->bannerContent,
            ];
        }
        $array = $this->content->toArray();
        if ($this->mode == 'new'){
            $array[] = $content;
            $this->content = collect($array);
        }
        else $this->content[$this->mode] = $content;
        $this->hide('content');
    }

    public function hide($id)
    {
        $this->resetContentInput();
        $this->resetErrorBag();
        $this->emitHideModal($id);
    }

    public function unSetCase($key)
    {
        $this->authorizing('edit_settings_fag');
        unset($this->contentCase[$key]);
    }

    public function unSetContent($key)
    {
        $this->authorizing('edit_settings_fag');
        unset($this->content[$key]);
    }

    public function resetContentInput()
    {
        $this->reset(['title','moreLink','view','category','width','widthCase','type','contentCase','bannerImage','bannerLink','bannerContent']);
    }

    public function store()
    {
        $this->authorizing('edit_settings_fag');
        $this->resetErrorBag();
        $this->settingRepository::updateOrCreate(['name' => 'homeContent'], ['value' => json_encode($this->content)]);
        $this->settingRepository::updateOrCreate(['name' => 'slider'], ['value' => $this->slider ]);
        $this->settingRepository::updateOrCreate(['name' => 'sliderImage'], ['value' => $this->sliderImage ]);
        $this->settingRepository::updateOrCreate(['name' => 'sliderLink'], ['value' => $this->sliderLink ]);
        $this->emitNotify('اطلاعات با موفقیت ثبت شد');
    }

    public function render()
    {
        return view('admin.settings.home-setting')
            ->extends('admin.layouts.admin');
    }
}
