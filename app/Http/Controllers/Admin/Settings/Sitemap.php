<?php

namespace App\Http\Controllers\Admin\Settings;

use App\Http\Controllers\BaseComponent;
use Illuminate\Support\Facades\Artisan;
use Spatie\Sitemap\SitemapGenerator;

class Sitemap extends BaseComponent
{
    public $method , $courses = false , $articles = false , $pages = [] , $images = [] , $home , $settings;

    public function mount()
    {
        $this->authorizing('show_settings_base');
    }

    public function store()
    {
        $this->validate([
            'courses' => ['boolean'],
            'articles' => ['boolean'],
            'home' => ['boolean'],
            'settings' => ['boolean'],
            'pages' => ['nullable','array'],
            'pages.*' => ['required','url','max:150']
        ],[],[
            'images' => 'تصاویر',
            'pages' => 'صفصخه ها',
            'articles' => 'مقالات',
            'home' => 'صفخه اصلی',
            'settings' => 'سایر صفخات',
            'courses' => 'دورها',
        ]);

        $options = [];
        if ($this->articles) {
            $options['--articles'] = true;
        }
        if ($this->courses) {
            $options['--courses'] = true;
        }
        if ($this->home) {
            $options['--home'] = true;
        }
        if ($this->settings) {
            $options['--settings'] = true;
        }
        if (is_array($this->pages) && sizeof($this->pages) > 0) {
            $options['--custom_pages'] = implode(',',$this->pages);
        }
        Artisan::call('sitemap:generate',$options);
        $this->reset(['pages','method','images','courses','articles','settings','home']);
        $this->emitNotify('فرایند نوشتن نقشه سایت فعال شد');
        Artisan::call('queue:work --stop-when-empty');
    }

    public function addRow($type) {
        $this->{$type}[] = [];
    }

    public function deleteRow($type , $key) {
        unset($this->{$type}[$key]);
    }

    public function render()
    {
        return view('admin.settings.sitemap')->extends('admin.layouts.admin');
    }
}
