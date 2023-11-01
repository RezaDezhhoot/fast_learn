<?php

namespace App\Http\Controllers\Admin\Settings;

use App\Http\Controllers\BaseComponent;
use App\Models\Setting;
use Illuminate\Support\Facades\Artisan;
use Spatie\Sitemap\SitemapGenerator;

class Sitemap extends BaseComponent
{
    public $method , $courses = false , $articles = false , $pages = [] , $images = [] , $home , $settings;

    public $sitemap = [];

    public function mount()
    {
        $this->authorizing('show_settings_base');
        $this->sitemap = Setting::getSingleRow('sitemap',[]);
    }

    public function store()
    {
        $this->validate([
            'sitemap.courses' => ['boolean','nullable'],
            'sitemap.articles' => ['boolean','nullable'],
            'sitemap.home' => ['boolean','nullable'],
            'sitemap.settings' => ['boolean','nullable'],
            'sitemap.pages' => ['nullable','array'],
            'sitemap.pages.*' => ['required','url','max:150']
        ],[],[
            'sitemap.images' => 'تصاویر',
            'sitemap.pages' => 'صفصخه ها',
            'sitemap.articles' => 'مقالات',
            'sitemap.home' => 'صفخه اصلی',
            'sitemap.settings' => 'سایر صفخات',
            'sitemap.courses' => 'دورها',
        ]);

        $options = [];
        if (isset($this->sitemap['articles']) && $this->sitemap['articles']) {
            $options['--articles'] = true;
        }
        if (isset($this->sitemap['courses']) && $this->sitemap['courses']) {
            $options['--courses'] = true;
        }
        if (isset($this->sitemap['home']) && $this->sitemap['home']) {
            $options['--home'] = true;
        }
        if (isset($this->sitemap['settings']) && $this->sitemap['settings']) {
            $options['--settings'] = true;
        }
        if (isset($this->sitemap['pages']) && is_array($this->sitemap['pages']) && sizeof($this->sitemap['pages']) > 0) {
            $options['--custom_pages'] = implode(',',$this->sitemap['pages']);
        }
        Setting::updateOrCreate(['name' => 'sitemap'],['value' => json_encode($this->sitemap)]);
        Artisan::call('sitemap:generate',$options);
        $this->emitNotify('فرایند نوشتن نقشه سایت فعال شد');
        Artisan::call('queue:work --stop-when-empty');
    }

    public function addRow($type) {
        $this->sitemap[$type][] = [];
    }

    public function deleteRow($type , $key) {
        unset($this->sitemap[$type][$key]);
    }

    public function render()
    {
        return view('admin.settings.sitemap')->extends('admin.layouts.admin');
    }
}
