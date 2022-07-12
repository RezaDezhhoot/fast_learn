<?php

namespace App\Providers;

use App\Events\AuthenticationEvent;
use App\Events\ExamEvent;
use App\Events\OrderEvent;
use App\Events\RegisterEvent;
use App\Listeners\SendAuthenticationNotify;
use App\Listeners\SendExamNotify;
use App\Listeners\SendOrderNotify;
use App\Listeners\SendRegisterNotify;
use App\Repositories\Interfaces\CategoryRepositoryInterface;
use App\Repositories\Interfaces\CourseRepositoryInterface;
use App\Repositories\Interfaces\TicketRepositoryInterface;
use Illuminate\Auth\Events\Registered;
use Illuminate\Auth\Listeners\SendEmailVerificationNotification;
use Illuminate\Foundation\Support\Providers\EventServiceProvider as ServiceProvider;
use Illuminate\Support\Facades\Event;

class EventServiceProvider extends ServiceProvider
{
    /**
     * The event listener mappings for the application.
     *
     * @var array<class-string, array<int, class-string>>
     */
    protected $listen = [
        Registered::class => [
            SendEmailVerificationNotification::class,
        ],
    ];

    /**
     * Register any events for your application.
     *
     * @return void
     */
    public function boot(): void
    {
        Event::listen(
            AuthenticationEvent::class,
            [SendAuthenticationNotify::class, 'handle']
        );
        Event::listen(
            RegisterEvent::class,
            [SendRegisterNotify::class, 'handle']
        );
        Event::listen(
            ExamEvent::class,
            [SendExamNotify::class, 'handle']
        );
        Event::listen(
            OrderEvent::class,
            [SendOrderNotify::class, 'handle']
        );

        app(TicketRepositoryInterface::class)::observe();
        app(CategoryRepositoryInterface::class)::observe();
        app(CourseRepositoryInterface::class)::observe();
    }

    /**
     * Determine if events and listeners should be automatically discovered.
     *
     * @return bool
     */
    public function shouldDiscoverEvents(): bool
    {
        return false;
    }
}