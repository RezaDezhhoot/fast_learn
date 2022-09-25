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
        $setting_table = 'settings';
        if (Schema::hasTable($setting_table))
        {
            $site_key = DB::table($setting_table)->where('name','site_key')->first();
            $secret_key = DB::table($setting_table)->where('name','secret_key')->first();
            if (!empty($site_key->value) && !empty($secret_key->value))
            {
                if (preg_match('#^6[0-9a-zA-Z_-]{39}$#', $site_key->value) && preg_match('#^6[0-9a-zA-Z_-]{39}$#', $secret_key->value)){
                    $config = array(
                        'site_key' => $site_key->value,
                        'secret_key' => $secret_key->value,
                    );
                    config(['services.recaptcha' => $config]);
                }
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
