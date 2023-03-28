<?php

namespace App\Providers;

use App\Repositories\Classes\ArticleRepository;
use App\Repositories\Classes\BankAccountRepository;
use App\Repositories\Classes\CategoryRepository;
use App\Repositories\Classes\CertificateRepository;
use App\Repositories\Classes\ChapterRepository;
use App\Repositories\Classes\ChapterTranscriptRepository;
use App\Repositories\Classes\ChoiceRepository;
use App\Repositories\Classes\CommentRepository;
use App\Repositories\Classes\ContactUsRepository;
use App\Repositories\Classes\CourseRepository;
use App\Repositories\Classes\EpisodeRepository;
use App\Repositories\Classes\EpisodeTranscriptRepository;
use App\Repositories\Classes\EventRepository;
use App\Repositories\Classes\FormRepository;
use App\Repositories\Classes\GroupRepository;
use App\Repositories\Classes\HomeworkRepository;
use App\Repositories\Classes\IncomingMethodRepository;
use App\Repositories\Classes\LastActivityRepository;
use App\Repositories\Classes\LogRepository;
use App\Repositories\Classes\NewCourseChatRepository;
use App\Repositories\Classes\NewCourseRepository;
use App\Repositories\Classes\NotificationRepository;
use App\Repositories\Classes\OrderDetailRepository;
use App\Repositories\Classes\OrderNoteRepository;
use App\Repositories\Classes\OrderRepository;
use App\Repositories\Classes\OrganRepository;
use App\Repositories\Classes\OtpRepository;
use App\Repositories\Classes\PaymentRepository;
use App\Repositories\Classes\PermissionRepository;
use App\Repositories\Classes\QuestionRepository;
use App\Repositories\Classes\QuizRepository;
use App\Repositories\Classes\ReductionMetaRepository;
use App\Repositories\Classes\ReductionRepository;
use App\Repositories\Classes\RoleRepository;
use App\Repositories\Classes\SampleRepository;
use App\Repositories\Classes\SendRepository;
use App\Repositories\Classes\SettingRepository;
use App\Repositories\Classes\StoragePermissionRepository;
use App\Repositories\Classes\StorageRepository;
use App\Repositories\Classes\TagRepository;
use App\Repositories\Classes\TeacherCheckoutRepository;
use App\Repositories\Classes\TeacherRepository;
use App\Repositories\Classes\TeacherRequestRepository;
use App\Repositories\Classes\TicketRepository;
use App\Repositories\Classes\TranscriptRepository;
use App\Repositories\Classes\UserDetailRepository;
use App\Repositories\Classes\UserRepository;
use App\Repositories\Classes\ViolationReportRepository;
use App\Repositories\Classes\WalletRepository;
use App\Repositories\Interfaces\ArticleRepositoryInterface;
use App\Repositories\Interfaces\BankAccountRepositoryInterface;
use App\Repositories\Interfaces\CategoryRepositoryInterface;
use App\Repositories\Interfaces\CertificateRepositoryInterface;
use App\Repositories\Interfaces\ChapterRepositoryInterface;
use App\Repositories\Interfaces\ChapterTranscriptRepositoryInterface;
use App\Repositories\Interfaces\ChoiceRepositoryInterface;
use App\Repositories\Interfaces\CommentRepositoryInterface;
use App\Repositories\Interfaces\ContactUsRepositoryInterface;
use App\Repositories\Interfaces\CourseRepositoryInterface;
use App\Repositories\Interfaces\EpisodeRepositoryInterface;
use App\Repositories\Interfaces\EpisodeTranscriptRepositoryInterface;
use App\Repositories\Interfaces\EventRepositoryInterface;
use App\Repositories\Interfaces\FormRepositoryInterface;
use App\Repositories\Interfaces\GroupRepositoryInterface;
use App\Repositories\Interfaces\HomeworkRepositoryInterface;
use App\Repositories\Interfaces\IncomingMethodRepositoryInterface;
use App\Repositories\Interfaces\LastActivityRepositoryInterface;
use App\Repositories\Interfaces\LogRepositoryInterface;
use App\Repositories\Interfaces\NewCourseChatRepositoryInterface;
use App\Repositories\Interfaces\NewCourseRepositoryInterface;
use App\Repositories\Interfaces\NotificationRepositoryInterface;
use App\Repositories\Interfaces\OrderDetailRepositoryInterface;
use App\Repositories\Interfaces\OrderNoteRepositoryInterface;
use App\Repositories\Interfaces\OrderRepositoryInterface;
use App\Repositories\Interfaces\OrganRepositoryInterface;
use App\Repositories\Interfaces\OtpRepositoryInterface;
use App\Repositories\Interfaces\PaymentRepositoryInterface;
use App\Repositories\Interfaces\PermissionRepositoryInterface;
use App\Repositories\Interfaces\QuestionRepositoryInterface;
use App\Repositories\Interfaces\QuizRepositoryInterface;
use App\Repositories\Interfaces\ReductionMetaRepositoryInterface;
use App\Repositories\Interfaces\ReductionRepositoryInterface;
use App\Repositories\Interfaces\RoleRepositoryInterface;
use App\Repositories\Interfaces\SampleRepositoryInterface;
use App\Repositories\Interfaces\SendRepositoryInterface;
use App\Repositories\Interfaces\SettingRepositoryInterface;
use App\Repositories\Interfaces\StoragePermissionRepositoryInterface;
use App\Repositories\Interfaces\StorageRepositoryInterface;
use App\Repositories\Interfaces\TagRepositoryInterface;
use App\Repositories\Interfaces\TeacherCheckoutRepositoryInterface;
use App\Repositories\Interfaces\TeacherRepositoryInterface;
use App\Repositories\Interfaces\TeacherRequestRepositoryInterface;
use App\Repositories\Interfaces\TicketRepositoryInterface;
use App\Repositories\Interfaces\TranscriptRepositoryInterface;
use App\Repositories\Interfaces\UserDetailRepositoryInterface;
use App\Repositories\Interfaces\UserRepositoryInterface;
use App\Repositories\Interfaces\ViolationReportRepositoryInterface;
use App\Repositories\Interfaces\WalletRepositoryInterface;
use Illuminate\Support\ServiceProvider;
use RecursiveDirectoryIterator;
use RecursiveIteratorIterator;

class RepositoryServiceProvider extends ServiceProvider
{
    /**
     * Register services.
     *
     * @return void
     */
    public function register(): void
    {
        $this->app->bind(
            ArticleRepositoryInterface::class,
            ArticleRepository::class
        );

        $this->app->bind(
            CategoryRepositoryInterface::class,
            CategoryRepository::class
        );

        $this->app->bind(
            CertificateRepositoryInterface::class,
            CertificateRepository::class
        );

        $this->app->bind(
            ChoiceRepositoryInterface::class,
            ChoiceRepository::class
        );

        $this->app->bind(
            CommentRepositoryInterface::class,
            CommentRepository::class
        );

        $this->app->bind(
            CourseRepositoryInterface::class,
            CourseRepository::class
        );

        $this->app->bind(
            EpisodeRepositoryInterface::class,
            EpisodeRepository::class
        );

        $this->app->bind(
            EventRepositoryInterface::class,
            EventRepository::class
        );

        $this->app->bind(
            HomeworkRepositoryInterface::class,
            HomeworkRepository::class
        );


        $this->app->bind(
            NotificationRepositoryInterface::class,
            NotificationRepository::class
        );

        $this->app->bind(
            OrderRepositoryInterface::class,
            OrderRepository::class
        );

        $this->app->bind(
            OrderDetailRepositoryInterface::class,
            OrderDetailRepository::class
        );

        $this->app->bind(
            OrderNoteRepositoryInterface::class,
            OrderNoteRepository::class
        );


        $this->app->bind(
            OtpRepositoryInterface::class,
            OtpRepository::class
        );

        $this->app->bind(
            PaymentRepositoryInterface::class,
            PaymentRepository::class
        );

        $this->app->bind(
            PermissionRepositoryInterface::class,
            PermissionRepository::class
        );

        $this->app->bind(
            QuestionRepositoryInterface::class,
            QuestionRepository::class
        );

        $this->app->bind(
            QuizRepositoryInterface::class,
            QuizRepository::class
        );

        $this->app->bind(
            ReductionRepositoryInterface::class,
            ReductionRepository::class
        );

        $this->app->bind(
            ReductionMetaRepositoryInterface::class,
            ReductionMetaRepository::class
        );

        $this->app->bind(
            RoleRepositoryInterface::class,
            RoleRepository::class
        );

        $this->app->bind(
            SendRepositoryInterface::class,
            SendRepository::class
        );

        $this->app->bind(
            SettingRepositoryInterface::class,
            SettingRepository::class
        );

        $this->app->bind(
            TagRepositoryInterface::class,
            TagRepository::class
        );

        $this->app->bind(
            TeacherRepositoryInterface::class,
            TeacherRepository::class
        );

        $this->app->bind(
            TicketRepositoryInterface::class,
            TicketRepository::class
        );

        $this->app->bind(
            TranscriptRepositoryInterface::class,
            TranscriptRepository::class
        );

        $this->app->bind(
            UserDetailRepositoryInterface::class,
            UserDetailRepository::class
        );

        $this->app->bind(
            UserRepositoryInterface::class,
            UserRepository::class
        );

        $this->app->bind(
            WalletRepositoryInterface::class,
            WalletRepository::class
        );

        $this->app->bind(
            ContactUsRepositoryInterface::class,
            ContactUsRepository::class
        );

        $this->app->bind(
            LogRepositoryInterface::class,
            LogRepository::class
        );

        $this->app->bind(
            SampleRepositoryInterface::class,
            SampleRepository::class
        );

        $this->app->bind(
            StorageRepositoryInterface::class,
            StorageRepository::class
        );

        $this->app->bind(
            BankAccountRepositoryInterface::class,
            BankAccountRepository::class
        );

        $this->app->bind(
            IncomingMethodRepositoryInterface::class,
            IncomingMethodRepository::class
        );

        $this->app->bind(
            NewCourseRepositoryInterface::class,
            NewCourseRepository::class
        );

        $this->app->bind(
            TeacherCheckoutRepositoryInterface::class,
            TeacherCheckoutRepository::class
        );

        $this->app->bind(
            TeacherRequestRepositoryInterface::class,
            TeacherRequestRepository::class
        );

        $this->app->bind(
            StoragePermissionRepositoryInterface::class,
            StoragePermissionRepository::class
        );

        $this->app->bind(
            LastActivityRepositoryInterface::class,
            LastActivityRepository::class
        );

        $this->app->bind(
            NewCourseChatRepositoryInterface::class,
            NewCourseChatRepository::class
        );

        $this->app->bind(
            EpisodeTranscriptRepositoryInterface::class,
            EpisodeTranscriptRepository::class
        );

        $this->app->bind(
            ChapterRepositoryInterface::class,
            ChapterRepository::class
        );

        $this->app->bind(
            ChapterTranscriptRepositoryInterface::class,
            ChapterTranscriptRepository::class
        );

        $this->app->bind(
            ViolationReportRepositoryInterface::class,
            ViolationReportRepository::class
        );

        $this->app->bind(
            FormRepositoryInterface::class,
            FormRepository::class
        );

        $this->app->bind(
            OrganRepositoryInterface::class,
            OrganRepository::class
        );

        $this->app->bind(
            GroupRepositoryInterface::class,
            GroupRepository::class
        );
    }

    /**
     * Bootstrap services.
     *
     * @return void
     */
    public function boot(): void
    {
        //
    }
}
