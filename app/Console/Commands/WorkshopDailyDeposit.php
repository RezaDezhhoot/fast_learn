<?php

namespace App\Console\Commands;

use App\Models\Setting;
use App\Models\WorkshopBot;
use Illuminate\Console\Command;

class WorkshopDailyDeposit extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'bot:workshop';

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
        WorkshopBot::query()
            ->where('status',true)
            ->chunkById(100 , function ($items) {
                foreach ($items as $item) {
                    $item->update([
                        'status' => false
                    ]);
                    $item->user->deposit($item->amount , ['description' => 'واریز روزانه گارکاه']);
                }
            });
    }
}
