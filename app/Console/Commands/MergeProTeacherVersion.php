<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;

class MergeProTeacherVersion extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'teacher:run';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'merge teacher features';

    /**
     * Execute the console command.
     *
     * @return int
     */
    public function handle()
    {
        return 0;
    }
}
