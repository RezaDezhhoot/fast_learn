<?php

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Admin Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/
Route::prefix('admin')->middleware(['auth','role:admin'])->as('admin.')->group(function (){
    Route::get('/dashboard',App\Http\Controllers\Admin\Dashboard\IndexDashboard::class)->name('dashboard');
    Route::get('/profile',App\Http\Controllers\Admin\Profile\Profile::class)->name('profile');
    Route::get('/articles',App\Http\Controllers\Admin\Articles\IndexArticle::class)->name('article');
    Route::get('/articles/{action}/{id?}',App\Http\Controllers\Admin\Articles\StoreArticle::class)->name('store.article');
    Route::get('/categories',App\Http\Controllers\Admin\Categories\IndexCategory::class)->name('category');
    Route::get('/categories/{action}/{id?}',App\Http\Controllers\Admin\Categories\StoreCategory::class)->name('store.category');
    Route::get('/certificates',App\Http\Controllers\Admin\Certificates\IndexCertificate::class)->name('certificate');
    Route::get('/certificates/{action}/{id?}',App\Http\Controllers\Admin\Certificates\StoreCertificate::class)->name('store.certificate');
    Route::get('/comments',App\Http\Controllers\Admin\Comments\IndexComment::class)->name('comment');
    Route::get('/comments/{action}/{id?}',App\Http\Controllers\Admin\Comments\StoreComment::class)->name('store.comment');
    Route::get('/courses',App\Http\Controllers\Admin\Courses\IndexCourse::class)->name('course');
    Route::get('/courses/{action}/{id?}',App\Http\Controllers\Admin\Courses\StoreCourse::class)->name('store.course');

    Route::get('/chapters',App\Http\Controllers\Admin\Chapters\IndexChapter::class)->name('chapter');
    Route::get('/chapters/{action}/{id?}',App\Http\Controllers\Admin\Chapters\StoreChapter::class)->name('store.chapter');

    Route::get('/episodes',App\Http\Controllers\Admin\Episodes\IndexEpisode::class)->name('episode');
    Route::get('/episodes/{action}/{id?}',App\Http\Controllers\Admin\Episodes\StoreEpisode::class)->name('store.episode');
    Route::get('/events',App\Http\Controllers\Admin\Events\IndexEvent::class)->name('event');
    Route::get('/events/{action}/{id?}',App\Http\Controllers\Admin\Events\StoreEvent::class)->name('store.event');
    Route::get('/notifications',App\Http\Controllers\Admin\Notifications\IndexNotification::class)->name('notification');
    Route::get('/notifications/{action}/{id?}',App\Http\Controllers\Admin\Notifications\StoreNotification::class)->name('store.notification');
    Route::get('/orders',App\Http\Controllers\Admin\Orders\IndexOrder::class)->name('order');
    Route::get('/orders/{action}/{id}',App\Http\Controllers\Admin\Orders\StoreOrder::class)->name('store.order');
    Route::get('/order/{action}',App\Http\Controllers\Admin\Orders\CreateOrder::class)->name('create.order');
    Route::get('/payments',App\Http\Controllers\Admin\Payments\IndexPayment::class)->name('payment');
    Route::get('/payments/{action}/{id?}',App\Http\Controllers\Admin\Payments\StorePayment::class)->name('store.payment');
    Route::get('/questions',App\Http\Controllers\Admin\Questions\IndexQuestion::class)->name('question');
    Route::get('/questions/{action}/{id?}',App\Http\Controllers\Admin\Questions\StoreQuestion::class)->name('store.question');
    Route::get('/quizzes',App\Http\Controllers\Admin\Quizzes\IndexQuiz::class)->name('quiz');
    Route::get('/quizzes/{action}/{id?}',App\Http\Controllers\Admin\Quizzes\StoreQuiz::class)->name('store.quiz');
    Route::get('/reductions',App\Http\Controllers\Admin\Reductions\IndexReduction::class)->name('reduction');
    Route::get('/reductions/{action}/{id?}',App\Http\Controllers\Admin\Reductions\StoreReduction::class)->name('store.reduction');
    Route::get('/roles',App\Http\Controllers\Admin\Roles\IndexRole::class)->name('role');
    Route::get('/roles/{action}/{id?}',App\Http\Controllers\Admin\Roles\StoreRole::class)->name('store.role');
    Route::get('/tags',App\Http\Controllers\Admin\Tags\IndexTag::class)->name('tag');
    Route::get('/tags/{action}/{id?}',App\Http\Controllers\Admin\Tags\StoreTag::class)->name('store.tag');
    Route::get('/teachers',App\Http\Controllers\Admin\Teachers\IndexTeacher::class)->name('teacher');
    Route::get('/teachers/{action}/{id?}',App\Http\Controllers\Admin\Teachers\StoreTeacher::class)->name('store.teacher');
    Route::get('/tickets',App\Http\Controllers\Admin\Tickets\IndexTicket::class)->name('ticket');
    Route::get('/tickets/{action}/{id?}',App\Http\Controllers\Admin\Tickets\StoreTicket::class)->name('store.ticket');
    Route::get('/transcripts',App\Http\Controllers\Admin\Transcripts\IndexTranscript::class)->name('transcript');
    Route::get('/transcripts/{action}/{id?}',App\Http\Controllers\Admin\Transcripts\StoreTranscript::class)->name('store.transcript');
    Route::get('/users',App\Http\Controllers\Admin\Users\IndexUser::class)->name('user');
    Route::get('/users/{action}/{id?}',App\Http\Controllers\Admin\Users\StoreUser::class)->name('store.user');
    Route::get('/contact-us',App\Http\Controllers\Admin\Contacts\IndexContactUs::class)->name('contact');
    Route::get('/contact-us/{action?}/{id?}',App\Http\Controllers\Admin\Contacts\StoreContactUs::class)->name('store.contact');
    Route::get('/settings/base', App\Http\Controllers\Admin\Settings\BaseSetting::class)->name('setting.base');
    Route::get('/settings/home', App\Http\Controllers\Admin\Settings\HomeSetting::class)->name('setting.home');
    Route::get('/settings/sms', App\Http\Controllers\Admin\Settings\SmsSetting::class)->name('setting.sms');
    Route::get('/settings/about-us', App\Http\Controllers\Admin\Settings\AboutSetting::class)->name('setting.aboutUs');
    Route::get('/settings/sitemap', App\Http\Controllers\Admin\Settings\Sitemap::class)->name('setting.sitemap');
    Route::get('/settings/contact-us', App\Http\Controllers\Admin\Settings\ContactSetting::class)->name('setting.contactUs');
    Route::get('/settings/fag', App\Http\Controllers\Admin\Settings\FagSetting::class)->name('setting.fag');
    Route::get('/settings/fag/{action}/{id?}', App\Http\Controllers\Admin\Settings\StoreFag::class)->name('setting.fag.create');
    Route::get('/logs', App\Http\Controllers\Admin\Logs\IndexLog::class)->name('log');
    // v2-samples
    Route::get('/samples',App\Http\Controllers\Admin\Samples\IndexSample::class)->name('sample');
    Route::get('/samples/{action}/{id?}',App\Http\Controllers\Admin\Samples\StoreSample::class)->name('store.sample');
    // v2-storages
    Route::get('/storages',App\Http\Controllers\Admin\Storages\IndexStorages::class)->name('storage');
    Route::get('/storages/{action}/{id?}',App\Http\Controllers\Admin\Storages\StoreStorages::class)->name('store.storage');
    // v3-teachers
    Route::get('/acl',App\Http\Controllers\Admin\StoragePermissions\IndexStoragePermission::class)->name('acl');
    Route::get('/acl/{action}/{id?}',App\Http\Controllers\Admin\StoragePermissions\StoreStoragePermission::class)->name('store.acl');
    Route::get('/checkouts',App\Http\Controllers\Admin\TeacherCheckouts\IndexTeacherCheckout::class)->name('checkout');
    Route::get('/checkouts/{action}/{id?}',App\Http\Controllers\Admin\TeacherCheckouts\StoreTeacherCheckout::class)->name('store.checkout');
    Route::get('/requests',App\Http\Controllers\Admin\TeacherRequests\IndexTeacherRequest::class)->name('request');
    Route::get('/requests/{action}/{id?}',App\Http\Controllers\Admin\TeacherRequests\StoreTeacherRequest::class)->name('store.request');
    Route::get('/accounts',App\Http\Controllers\Admin\BankAccounts\IndexBankAccount::class)->name('account');
    Route::get('/accounts/{action}/{id?}',App\Http\Controllers\Admin\BankAccounts\StoreBankAccount::class)->name('store.account');
    Route::get('/incoming-methods',App\Http\Controllers\Admin\IncomingMethods\IndexIncomingMethod::class)->name('incoming');
    Route::get('/incoming-methods/{action}/{id?}',App\Http\Controllers\Admin\IncomingMethods\StoreIncomingMethod::class)->name('store.incoming');
    Route::get('/new-courses',App\Http\Controllers\Admin\NewCourses\IndexNewCourse::class)->name('newCourse');
    Route::get('/new-courses/{action}/{id?}',App\Http\Controllers\Admin\NewCourses\StoreNewCourse::class)->name('store.newCourse');
    Route::get('/settings/apply', App\Http\Controllers\Admin\Settings\Law::class)->name('setting.apply');
    Route::get('/episode-transcripts',App\Http\Controllers\Admin\EpisodeTranscripts\IndexEpisodeTranscript::class)->name('episodeTranscript');
    Route::get('/episode-transcripts/{action}/{id?}',App\Http\Controllers\Admin\EpisodeTranscripts\StoreEpisodeTranscript::class)->name('store.episodeTranscript');

    Route::get('/chapter-transcripts',App\Http\Controllers\Admin\ChapterTranscripts\IndexChapterTranscript::class)->name('chapterTranscript');
    Route::get('/chapter-transcripts/{action}/{id?}',App\Http\Controllers\Admin\ChapterTranscripts\StoreChapterTranscript::class)->name('store.chapterTranscript');

    Route::get('/reports/violations' , App\Http\Controllers\Admin\Reports\IndexViolation::class)->name('report.violation');

    Route::get('/roll-calls',App\Http\Controllers\Admin\RollCalls\IndexRollCall::class)->name('rollCall');
    Route::get('/roll-calls/{id}',App\Http\Controllers\Admin\RollCalls\StoreRollCall::class)->name('store.rollCall');

    Route::get('/forms',App\Http\Controllers\Admin\Forms\IndexForm::class)->name('form');
    Route::get('/forms/{action}/{id?}',App\Http\Controllers\Admin\Forms\StoreForm::class)->name('store.form');

    Route::get('/forms-answers',App\Http\Controllers\Admin\Forms\IndexAnswers::class)->name('answer');
    Route::get('/forms-answers/{action}/{id}',App\Http\Controllers\Admin\Forms\StoreAnswers::class)->name('store.answer');
});
