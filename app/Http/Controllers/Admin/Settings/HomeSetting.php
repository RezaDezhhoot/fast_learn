<?php

namespace App\Http\Controllers\Admin\Settings;

use App\Http\Controllers\BaseComponent;
use App\Repositories\Interfaces\SettingRepositoryInterface;

class HomeSetting extends BaseComponent
{
    public $header , $content = [] , $i = 1 , $titleContent, $boxContent , $title , $type  , $width , $bgImage  , $moreLink , $widthCase;
    public $category , $bannerLink , $bannerImage , $bannerContent , $contentCase = [] ;
    public $titleSlider , $slider , $sliderImage , $sliderLink , $sliders = [] , $modeSlider , $row , $view;

    public $box_title , $box_image , $box_link , $box_width , $box_description , $box;

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
            'organizations' => 'سازمان ها'
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

        $this->data['boxWidth'] = [
            '3' => '25%',
            '4' => '33.33%',
            '6' => '50%',
            '12' => '100%',
        ];
        $this->content = collect($this->settingRepository->getRow('homeContent',[]));
        $this->box = collect($this->settingRepository->getRow('homeBox',[]));
        $this->slider = $this->settingRepository->getRow('slider');
        $this->sliderImage = $this->settingRepository->getRow('sliderImage');
        $this->sliderLink = $this->settingRepository->getRow('sliderLink');
    }

    public function addBox($title)
    {
        $this->authorizing('edit_settings_home');
        if ($title <> 'new')
        {
            $this->box_title = $this->box[$title]['title'];
            $this->box_link = $this->box[$title]['link'];
            $this->box_image = $this->box[$title]['image'];
            $this->box_description = $this->box[$title]['description'];
            $this->box_width = $this->box[$title]['width'];
        } else {
            $this->resetBoxInput();
            $this->boxContent = 'باکس  جدید';
        }
        $this->mode = $title;
        $this->emitShowModal('box');
    }

    public function addContent($title)
    {
        $this->authorizing('edit_settings_home');
        if ($title <> 'new')
        {
            $this->titleContent = $this->content[$title]['title'];
            $this->view = $this->content[$title]['view'];
            $this->title = $this->content[$title]['title'];
            $this->moreLink = $this->content[$title]['moreLink'] ?? '';
            $this->category = $this->content[$title]['category'];
            $this->type = $this->content[$title]['type'] ?? '';
            $this->widthCase = $this->content[$title]['widthCase'];

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
        $this->authorizing('edit_settings_home');
        $this->contentCase[] = '';
    }


    public function storeContent()
    {
        $this->authorizing('edit_settings_fag');
        $fields = [
            'title' => ['required', 'string'],
            'view' => ['required', 'integer'],
            'moreLink' => ['nullable', 'url'],
            'category' => ['required','string' ,'in:'.implode(',',array_keys($this->data['category']))],
            'type' => ['required','in:slider,grid'],
            'contentCase.*'=> ['required','numeric','exists:'.$this->category.',id'],
        ];
        $messages = [
            'title' => 'عنوان',
            'view' => 'شماره نمایش',
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
            'width' => '12',
            'category' => $this->category,
            'type' => $this->type,
            'widthCase' => $this->widthCase,
            'moreLink' => $this->moreLink,
            'contentCase' => $this->contentCase
        ];
        $array = $this->content->toArray();
        if ($this->mode == 'new'){
            $array[] = $content;
            $this->content = collect($array);
        }
        else $this->content[$this->mode] = $content;
        $this->hide('content');
        $this->resetContentInput();
    }

    public function storeBox()
    {
        $this->authorizing('edit_settings_fag');
        $fields = [
            'box_title' => ['required', 'string'],
            'box_link' => ['nullable', 'url'],
            'box_image' => ['required','string' ,'max:1400'],
            'box_description' => ['required','string'],
            'box_width' => ['required', 'numeric','in:'.implode(',',array_keys($this->data['boxWidth']))]
        ];
        $messages = [
            'box_title' => 'عنوان',
            'box_link' => 'لینک',
            'box_image' => 'تصویر',
            'box_description' => 'توضیحات',
            'box_width' => 'عرض باکس',
        ];
        $this->validate($fields,[], $messages);
        $box = [
            'title' => $this->box_title,
            'link' => $this->box_link,
            'image' => $this->box_image,
            'description' => $this->box_description,
            'width' => $this->box_width,
        ];
        $array = $this->box->toArray();
        if ($this->mode == 'new'){
            $array[] = $box;
            $this->box = collect($array);
        }
        else $this->box[$this->mode] = $box;
        $this->hide('box');
        $this->resetBoxInput();
    }

    public function hide($id)
    {
        $this->resetContentInput();
        $this->resetErrorBag();
        $this->emitHideModal($id);
    }

    public function unSetCase($key)
    {
        $this->authorizing('edit_settings_home');
        unset($this->contentCase[$key]);
    }

    public function unSetContent($key)
    {
        $this->authorizing('edit_settings_home');
        unset($this->content[$key]);
    }

    public function unSetBox($key)
    {
        $this->authorizing('edit_settings_home');
        unset($this->box[$key]);
    }

    public function resetContentInput()
    {
        $this->reset(['title','mode','moreLink','view','category','width','widthCase','type','contentCase','bannerImage','bannerLink','bannerContent']);
    }

    public function resetBoxInput()
    {
        $this->reset(['box_title','mode','box_link','box_image','box_description','box_width']);
    }

    public function store()
    {
        $this->authorizing('edit_settings_home');
        $this->resetErrorBag();
        $this->settingRepository::updateOrCreate(['name' => 'homeContent'], ['value' => json_encode($this->content)]);
        $this->settingRepository::updateOrCreate(['name' => 'homeBox'], ['value' => json_encode($this->box)]);
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
