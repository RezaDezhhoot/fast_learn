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
Route::prefix('admin')->middleware(['auth','role:admin'])->group(function (){
    Route::get('/dashboard',App\Http\Controllers\Admin\Dashboard\IndexDashboard::class)->name('admin.dashboard');
    Route::get('/profile',App\Http\Controllers\Admin\Profile\Profile::class)->name('admin.profile');
    Route::get('/articles',App\Http\Controllers\Admin\Articles\IndexArticle::class)->name('admin.article');
    Route::get('/articles/{action}/{id?}',App\Http\Controllers\Admin\Articles\StoreArticle::class)->name('admin.store.article');
    Route::get('/categories',App\Http\Controllers\Admin\Categories\IndexCategory::class)->name('admin.category');
    Route::get('/categories/{action}/{id?}',App\Http\Controllers\Admin\Categories\StoreCategory::class)->name('admin.store.category');
    Route::get('/certificates',App\Http\Controllers\Admin\Certificates\IndexCertificate::class)->name('admin.certificate');
    Route::get('/certificates/{action}/{id?}',App\Http\Controllers\Admin\Certificates\StoreCertificate::class)->name('admin.store.certificate');
    Route::get('/comments',App\Http\Controllers\Admin\Comments\IndexComment::class)->name('admin.comment');
    Route::get('/comments/{action}/{id?}',App\Http\Controllers\Admin\Comments\StoreComment::class)->name('admin.store.comment');
    Route::get('/courses',App\Http\Controllers\Admin\Courses\IndexCourse::class)->name('admin.course');
    Route::get('/courses/{action}/{id?}',App\Http\Controllers\Admin\Courses\StoreCourse::class)->name('admin.store.course');
    Route::get('/episodes',App\Http\Controllers\Admin\Episodes\IndexEpisode::class)->name('admin.episode');
    Route::get('/episodes/{action}/{id?}',App\Http\Controllers\Admin\Episodes\StoreEpisode::class)->name('admin.store.episode');
    Route::get('/events',App\Http\Controllers\Admin\Events\IndexEvent::class)->name('admin.event');
    Route::get('/events/{action}/{id?}',App\Http\Controllers\Admin\Events\StoreEvent::class)->name('admin.store.event');
    Route::get('/notifications',App\Http\Controllers\Admin\Notifications\IndexNotification::class)->name('admin.notification');
    Route::get('/notifications/{action}/{id?}',App\Http\Controllers\Admin\Notifications\StoreNotification::class)->name('admin.store.notification');
    Route::get('/orders',App\Http\Controllers\Admin\Orders\IndexOrder::class)->name('admin.order');
    Route::get('/orders/{action}/{id}',App\Http\Controllers\Admin\Orders\StoreOrder::class)->name('admin.store.order');
    Route::get('/order/{action}',App\Http\Controllers\Admin\Orders\CreateOrder::class)->name('admin.create.order');
    Route::get('/payments',App\Http\Controllers\Admin\Payments\IndexPayment::class)->name('admin.payment');
    Route::get('/payments/{action}/{id?}',App\Http\Controllers\Admin\Payments\StorePayment::class)->name('admin.store.payment');
    Route::get('/questions',App\Http\Controllers\Admin\Questions\IndexQuestion::class)->name('admin.question');
    Route::get('/questions/{action}/{id?}',App\Http\Controllers\Admin\Questions\StoreQuestion::class)->name('admin.store.question');
    Route::get('/quizzes',App\Http\Controllers\Admin\Quizzes\IndexQuiz::class)->name('admin.quiz');
    Route::get('/quizzes/{action}/{id?}',App\Http\Controllers\Admin\Quizzes\StoreQuiz::class)->name('admin.store.quiz');
    Route::get('/reductions',App\Http\Controllers\Admin\Reductions\IndexReduction::class)->name('admin.reduction');
    Route::get('/reductions/{action}/{id?}',App\Http\Controllers\Admin\Reductions\StoreReduction::class)->name('admin.store.reduction');
    Route::get('/roles',App\Http\Controllers\Admin\Roles\IndexRole::class)->name('admin.role');
    Route::get('/roles/{action}/{id?}',App\Http\Controllers\Admin\Roles\StoreRole::class)->name('admin.store.role');
    Route::get('/tags',App\Http\Controllers\Admin\Tags\IndexTag::class)->name('admin.tag');
    Route::get('/tags/{action}/{id?}',App\Http\Controllers\Admin\Tags\StoreTag::class)->name('admin.store.tag');
    Route::get('/teachers',App\Http\Controllers\Admin\Teachers\IndexTeacher::class)->name('admin.teacher');
    Route::get('/teachers/{action}/{id?}',App\Http\Controllers\Admin\Teachers\StoreTeacher::class)->name('admin.store.teacher');
    Route::get('/tickets',App\Http\Controllers\Admin\Tickets\IndexTicket::class)->name('admin.ticket');
    Route::get('/tickets/{action}/{id?}',App\Http\Controllers\Admin\Tickets\StoreTicket::class)->name('admin.store.ticket');
    Route::get('/transcripts',App\Http\Controllers\Admin\Transcripts\IndexTranscript::class)->name('admin.transcript');
    Route::get('/transcripts/{action}/{id?}',App\Http\Controllers\Admin\Transcripts\StoreTranscript::class)->name('admin.store.transcript');
    Route::get('/users',App\Http\Controllers\Admin\Users\IndexUser::class)->name('admin.user');
    Route::get('/users/{action}/{id?}',App\Http\Controllers\Admin\Users\StoreUser::class)->name('admin.store.user');
    Route::get('/contact-us',App\Http\Controllers\Admin\Contacts\IndexContactUs::class)->name('admin.contact');
    Route::get('/contact-us/{action?}/{id?}',App\Http\Controllers\Admin\Contacts\StoreContactUs::class)->name('admin.store.contact');
    Route::get('/settings/base', App\Http\Controllers\Admin\Settings\BaseSetting::class)->name('admin.setting.base');
    Route::get('/settings/home', App\Http\Controllers\Admin\Settings\HomeSetting::class)->name('admin.setting.home');
    Route::get('/settings/sms', App\Http\Controllers\Admin\Settings\SmsSetting::class)->name('admin.setting.sms');
    Route::get('/settings/about-us', App\Http\Controllers\Admin\Settings\AboutSetting::class)->name('admin.setting.aboutUs');
    Route::get('/settings/contact-us', App\Http\Controllers\Admin\Settings\ContactSetting::class)->name('admin.setting.contactUs');
    Route::get('/settings/fag', App\Http\Controllers\Admin\Settings\FagSetting::class)->name('admin.setting.fag');
    Route::get('/settings/fag/{action}/{id?}', App\Http\Controllers\Admin\Settings\StoreFag::class)->name('admin.setting.fag.create');
    Route::get('/logs', App\Http\Controllers\Admin\Logs\IndexLog::class)->name('admin.log');
    // v2-samples
    Route::get('/samples',App\Http\Controllers\Admin\Samples\IndexSample::class)->name('admin.sample');
    Route::get('/samples/{action}/{id?}',App\Http\Controllers\Admin\Samples\StoreSample::class)->name('admin.store.sample');
    // v2-storages
    Route::get('/storages',App\Http\Controllers\Admin\Storages\IndexStorages::class)->name('admin.storage');
    Route::get('/storages/{action}/{id?}',App\Http\Controllers\Admin\Storages\StoreStorages::class)->name('admin.store.storage');
    // v3-teachers
    Route::get('/acl',App\Http\Controllers\Admin\StoragePermissions\IndexStoragePermission::class)->name('admin.acl');
    Route::get('/acl/{action}/{id?}',App\Http\Controllers\Admin\StoragePermissions\StoreStoragePermission::class)->name('admin.store.acl');
    Route::get('/checkouts',App\Http\Controllers\Admin\TeacherCheckouts\IndexTeacherCheckout::class)->name('admin.checkout');
    Route::get('/checkouts/{action}/{id?}',App\Http\Controllers\Admin\TeacherCheckouts\StoreTeacherCheckout::class)->name('admin.store.checkout');
    Route::get('/requests',App\Http\Controllers\Admin\TeacherRequests\IndexTeacherRequest::class)->name('admin.request');
    Route::get('/requests/{action}/{id?}',App\Http\Controllers\Admin\TeacherRequests\StoreTeacherRequest::class)->name('admin.store.request');
    Route::get('/accounts',App\Http\Controllers\Admin\BankAccounts\IndexBankAccount::class)->name('admin.account');
    Route::get('/accounts/{action}/{id?}',App\Http\Controllers\Admin\BankAccounts\StoreBankAccount::class)->name('admin.store.account');
    Route::get('/incoming-methods',App\Http\Controllers\Admin\IncomingMethods\IndexIncomingMethod::class)->name('admin.incoming');
    Route::get('/incoming-methods/{action}/{id?}',App\Http\Controllers\Admin\IncomingMethods\StoreIncomingMethod::class)->name('admin.store.incoming');
    Route::get('/new-courses',App\Http\Controllers\Admin\NewCourses\IndexNewCourse::class)->name('admin.newCourse');
    Route::get('/new-courses/{action}/{id?}',App\Http\Controllers\Admin\NewCourses\StoreNewCourse::class)->name('admin.store.newCourse');
    Route::get('/settings/apply', App\Http\Controllers\Admin\Settings\Law::class)->name('admin.setting.apply');
    Route::get('/episode-transcripts',App\Http\Controllers\Admin\EpisodeTranscripts\IndexEpisodeTranscript::class)->name('admin.episodeTranscript');
    Route::get('/episode-transcripts/{action}/{id?}',App\Http\Controllers\Admin\EpisodeTranscripts\StoreEpisodeTranscript::class)->name('admin.store.episodeTranscript');
});
