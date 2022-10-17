<?php

namespace App\Providers;

use App\Enums\StorageEnum;
use App\Events\AuthenticationEvent;
use App\Events\ContactUsEvent;
use App\Events\ExamEvent;
use App\Events\OrderEvent;
use App\Events\RegisterEvent;
use App\Events\TeacherEvent;
use App\Listeners\ContactUsListener;
use App\Listeners\SendAuthenticationNotify;
use App\Listeners\SendExamNotify;
use App\Listeners\SendOrderNotify;
use App\Listeners\SendRegisterNotify;
use App\Listeners\TeacherListener;
use App\Repositories\Interfaces\CategoryRepositoryInterface;
use App\Repositories\Interfaces\CourseRepositoryInterface;
use App\Repositories\Interfaces\EventRepositoryInterface;
use App\Repositories\Interfaces\HomeworkRepositoryInterface;
use App\Repositories\Interfaces\SettingRepositoryInterface;
use App\Repositories\Interfaces\StorageRepositoryInterface;
use App\Repositories\Interfaces\TicketRepositoryInterface;
use Illuminate\Auth\Events\Registered;
use Illuminate\Auth\Listeners\SendEmailVerificationNotification;
use Illuminate\Foundation\Support\Providers\EventServiceProvider as ServiceProvider;
use Illuminate\Support\Facades\Artisan;
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
        # Event-Listeners
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

        Event::listen(
            ContactUsEvent::class,
            [ContactUsListener::class, 'handle']
        );

        Event::listen(
            TeacherEvent::class,
            [TeacherListener::class, 'handle']
        );



        $storage_repository = app(StorageRepositoryInterface::class);
        $setting_repository = app(SettingRepositoryInterface::class);
        # Observers
        app(TicketRepositoryInterface::class)::observe();
        app(CategoryRepositoryInterface::class)::observe();
        app(CourseRepositoryInterface::class)::observe();
        app(HomeworkRepositoryInterface::class)::observe();
        app(EventRepositoryInterface::class)::observe();
        $storage_repository::observe();

        Event::listen(
            'Alexusmai\LaravelFileManager\Events\FilesUploading',
            function ($event) use ($storage_repository , $setting_repository) {
                $allowFileTypes = [];
                $max_file_size = null;
                if (!in_array($event->disk(), StorageEnum::getStorages())) {
                    $storage = $storage_repository->first([['name', $event->disk()]]);
                    Artisan::call('cache:clear');
                    Artisan::call('config:clear');
                    if (!is_null($storage->file_types))
                        $allowFileTypes = explode(',', $storage->file_types);

                    $max_file_size = !empty($storage->max_file_size) ? (int)$storage->max_file_size : null;
                } else {
                    $max_file_size_db_public = $setting_repository->getRow('public_max_file_size');
                    $max_file_size_db_private = $setting_repository->getRow('private_max_file_size');
                    if ($event->disk() == StorageEnum::PUBLIC_LABEL) {
                        if (!empty($setting_repository->getRow('public_storage_file_types')))
                            $allowFileTypes = explode(',', $setting_repository->getRow('public_storage_file_types'));
                        $max_file_size = !empty($max_file_size_db_public) ? (int)$max_file_size_db_public : null ;
                    } else {
                        if (!empty($setting_repository->getRow('private_storage_file_types')))
                            $allowFileTypes = explode(',', $setting_repository->getRow('private_storage_file_types'));
                        $max_file_size = !empty($max_file_size_db_private) ? (int)$max_file_size_db_private : null ;

                    }
                }
                config(['file-manager.allowFileTypes' =>  $allowFileTypes]);
                config(['file-manager.maxUploadFileSize' =>  $max_file_size]);
            }
        );
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
