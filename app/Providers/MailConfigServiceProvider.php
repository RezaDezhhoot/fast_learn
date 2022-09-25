<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Config;
use Illuminate\Support\Facades\Schema;

class MailConfigServiceProvider extends ServiceProvider
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
            $email_host = DB::table($setting_table)->where('name','email_host')->first();
            if (!empty($email_host->value))
            {
                $email_user_name = DB::table($setting_table)->where('name','email_username')->first();
                $email_password = DB::table($setting_table)->where('name','email_password')->first();
                $config = array(
                    'transport' => 'smtp',
                    'host' => trim($email_host->value),
                    'port' => 465,
                    'encryption' => 'ssl',
                    'username' => trim($email_user_name->value),
                    'password' => trim($email_password->value),
                );
                Config::set('mail.mailers.smtp', $config);
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
