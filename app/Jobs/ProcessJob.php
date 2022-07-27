<?php

namespace App\Jobs;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldBeUnique;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;
use App\Jobs\ProcessEvent;
use App\Repositories\Interfaces\UserRepositoryInterface;

class ProcessJob implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    /**
     * Create a new job instance.
     *
     * @return void
     */
    public $orderBy , $count , $event ;
    protected $userRepository;

    public function __construct($event,$orderBy,$count)
    {
        $this->event = $event;
        $this->orderBy = $orderBy;
        $this->count = $count;
        $this->userRepository = app(UserRepositoryInterface::class);
    }

    /**
     * Execute the job.
     *
     * @return void
     */
    public function handle()
    {
        $users = $this->userRepository->getUsersForEvent($this->orderBy , $this->count)->toArray();
        # $users = array_chunk($users,40);
        foreach ($users as $item) {
            ProcessEvent::dispatch($this->event,$item)->onQueue($this->event->id);
        }
    }
}
