<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use App\Repositories\Interfaces\UserRepositoryInterface;
use App\Repositories\Interfaces\EventRepositoryInterface;
use App\Jobs\ProcessJob;
use Illuminate\Support\Facades\Artisan;

class SetJobsCommand extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'jobs:set {event} {--orderBy=} {--count=0}';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'insert jobs';

    private ?EventRepositoryInterface $eventRepository;

    /**
     * Execute the console command.
     *
     * @return int
     */

    public function __construct(UserRepositoryInterface $userRepository , EventRepositoryInterface $eventRepository)
    {
        parent::__construct();
        $this->userRepository = $userRepository;
        $this->eventRepository = $eventRepository;
    } 

    public function handle()
    {
        $event = $this->eventRepository->find($this->argument('event'));
        ProcessJob::dispatch($event,$this->option('orderBy'),$this->option('count'))->onQueue('start');
        if (!app()->environment('local')) 
            Artisan::call("queue:work --queue=start --stop-when-empty");

        return 0;
    }
}
