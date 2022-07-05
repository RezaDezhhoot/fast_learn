<?php

namespace App\Providers;

use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\ServiceProvider;

class RecaptchaServiceProvider extends ServiceProvider
{
    /**
     * Register services.
     *
     * @return void
     */
    public function register(): void
    {
        if (Schema::hasTable('settings'))
        {
            $site_key = DB::table('settings')->where('name','site_key')->first();
            $secret_key = DB::table('settings')->where('name','secret_key')->first();
            if (!empty($site_key->value) && !empty($secret_key->value))
            {
                $config = array(
                    'site_key' => $site_key->value,
                    'secret_key' => $secret_key->value,
                );
                config(['services.recaptcha' => $config]);
            }
        }
    }

    /**
     * Bootstrap services.
     *
     * @return void
     */
    public function boot()
    {
        //
    }
}
