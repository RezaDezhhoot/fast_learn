<?php

namespace App\Providers;

use Illuminate\Support\Facades\DB;
use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Facades\View;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        //
    }

    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        $logo = DB::table('settings')->where('name','logo')->first();
        $site_name = DB::table('settings')->where('name','title')->first();
        View::share('logo',$logo->value ?? '');
        View::share('site_title',$site_name->value ?? '');
    }
}
