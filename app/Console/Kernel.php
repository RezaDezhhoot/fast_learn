<?php

namespace App\Console;

use Illuminate\Console\Scheduling\Schedule;
use Illuminate\Foundation\Console\Kernel as ConsoleKernel;
use Illuminate\Support\Facades\Artisan;

class Kernel extends ConsoleKernel
{
    protected $commands = [
        Commands\SetPermissionsAndRoles::class,
        Commands\SetJobsCommand::class,
        Commands\MergeSampleQuestion::class,
    ];
    /**
     * Define the application's command schedule.
     *
     * @param  \Illuminate\Console\Scheduling\Schedule  $schedule
     * @return void
     */
    protected function schedule(Schedule $schedule): void
    {
         $schedule->call(function (){
             # Attempts to perform failed jobs
             Artisan::call('queue:retry all');
         })->days([1,3,5]);

        $schedule->call(function (){
            # Attempts to perform jobs
            Artisan::call('queue:work --stop-when-empty');
        })->weekdays();
    }

    /**
     * Register the commands for the application.
     *
     * @return void
     */
    protected function commands()
    {
        $this->load(__DIR__.'/Commands');

        require base_path('routes/console.php');
    }
}
