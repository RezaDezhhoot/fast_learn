<?php

namespace App\Jobs;

use App\Enums\EventEnum;
use App\Mail\EventMail;
use App\Repositories\Interfaces\EventRepositoryInterface;
use App\Repositories\Interfaces\SendRepositoryInterface;
use Exception;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldBeUnique;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Mail;
use Psy\Exception\ErrorException;

class ProcessEvent implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    private SendRepositoryInterface $sendRepository;
    private EventRepositoryInterface $eventRepository;

    public $timeout = 6;

    public $failOnTimeout = true;

    protected $event , $user;
    /**
     * Create a new job instance.
     *
     * @return void
     */
    public function __construct($event , $user)
    {
        $this->event = $event;
        $this->user = $user;
        $this->sendRepository = app(SendRepositoryInterface::class);
        $this->eventRepository = app(EventRepositoryInterface::class);
    }

    /**
     * Execute the job.
     *
     * @return void
     * @throws Exception
     */
    public function handle()
    {
        $this->start();

        if ($this->event->event == EventEnum::EMAIL)
            $this->sendRepository->sendEmail(new EventMail($this->event->title,$this->event->body),$this->user['email']);
        elseif ($this->event->event == EventEnum::SMS)
            $this->sendRepository->sendSMS($this->event->body,$this->user['phone']);

        $this->stop();
    }

    protected function start()
    {
        $this->eventRepository->update($this->event,['status'=>EventEnum::PROCESSING ,'result' =>
            'در حال پردازش عملیات ...'
        ]);
    }

    protected function stop()
    {
        $this->eventRepository->update($this->event,['status'=>EventEnum::OK ,'result' =>
            'عملیات با موفقیت انجام شد.'
        ]);
    }

    public function failed($e)
    {
        Log::emergency($e);
        $this->eventRepository->update($this->event,['status'=>EventEnum::FAILED,'result'=>
            'خطایی در هنگام انجام عملیات رخ داده است لطفا شارژ پنل پیامکی یا ایمیل خود را بررسی نمایید سپس مجدد امتحان کنید.',
            'errors' => $e
        ]);
    }
}
