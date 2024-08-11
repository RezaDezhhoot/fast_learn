<?php

namespace App\Console\Commands;

use App\Models\SchoolBot;
use App\Models\Setting;
use Illuminate\Console\Command;

class SchoolDailyDeposit extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'bot:school';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Command description';

    /**
     * Execute the console command.
     *
     * @return int
     */
    public function handle()
    {
        $now = now();
        $amount = Setting::getSingleRow('school_amount' , 0);
        SchoolBot::query()
            ->whereNull('last_deposit')->orWhere('last_deposit','<',$now->startOfDay())
            ->chunkById(100 , function ($items) use ($amount) {
                foreach ($items as $item) {
                    $item->update([
                        'last_deposit' => now(),
                        'amount' => $amount
                    ]);
                    $item->user->deposit($amount , ['description' => 'واریز روزانه آموزشگاه']);
                }
            });
    }
}
