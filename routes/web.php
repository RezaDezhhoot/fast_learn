<?php


use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/
Route::middleware(['auth'])->get('/storage/{episode}/{type}', App\Http\Controllers\StorageController::class)->name('storage');
Route::get('/',App\Http\Controllers\Site\Homes\Home::class)->name('home');
Route::get('/courses',App\Http\Controllers\Site\Courses\IndexCourse::class)->name('courses');
Route::get('/courses/{slug}',App\Http\Controllers\Site\Courses\SingleCourse::class)->name('course');
Route::get('/articles/{type}',App\Http\Controllers\Site\Articles\IndexArticle::class)->name('articles');
Route::get('/article/{type}/{slug}',App\Http\Controllers\Site\Articles\SingleArticle::class)->name('article');
Route::get('/contact-us',App\Http\Controllers\Site\Settings\Contact::class)->name('contact');
Route::get('/about-us',App\Http\Controllers\Site\Settings\About::class)->name('about');
Route::get('/fag',App\Http\Controllers\Site\Settings\Fag::class)->name('fag');
Route::get('/cart',App\Http\Controllers\Site\Carts\Cart::class)->name('cart');
Route::get('/auth',App\Http\Controllers\Site\Auth\Auth::class)->name('auth');
// Route::get('/teachers',App\Http\Controllers\Site\Teachers\IndexTeacher::class)->name('teachers');
// Route::get('/teachers/{id}',App\Http\Controllers\Site\Teachers\SingleTeacher::class)->name('teacher');
Route::get('/codes/{code}',App\Http\Controllers\CodeController::class)->name('codes');

Route::get('/sample-questions',App\Http\Controllers\Site\Samples\IndexSample::class)->name('samples');
Route::get('/sample-questions/{slug}',App\Http\Controllers\Site\Samples\SingleSample::class)->name('sample');

Route::middleware(['auth'])->group(function (){
    Route::get('/checkout',App\Http\Controllers\Site\Carts\Checkout::class)->name('checkout');
    Route::get('/verify/{gateway?}',App\Http\Controllers\Site\Carts\Verify::class)->name('verify');
});
Route::prefix('client')->middleware(['auth'])->group(function (){
    Route::get('/dashboard',App\Http\Controllers\Site\Client\Dashboard::class)->name('user.dashboard');
    Route::get('/courses',App\Http\Controllers\Site\Client\Courses::class)->name('user.courses');
    Route::get('/notifications',App\Http\Controllers\Site\Client\Notifications::class)->name('user.notifications');
    Route::get('/comments',App\Http\Controllers\Site\Client\Comments::class)->name('user.comments');
    Route::get('/tickets',App\Http\Controllers\Site\Client\Tickets::class)->name('user.tickets');
    Route::get('/tickets/{action}/{id?}',App\Http\Controllers\Site\Client\Ticket::class)->name('user.ticket');
    Route::get('/profile/{gateway?}',App\Http\Controllers\Site\Client\Profile::class)->name('user.profile');
    Route::get('/quizzes',App\Http\Controllers\Site\Client\Quizzes::class)->name('user.quizzes');
    Route::get('/quizzes/{id}',App\Http\Controllers\Site\Client\Quiz::class)->name('user.quiz');
    Route::get('/certificates',App\Http\Controllers\Site\Client\Certificates::class)->name('user.certificates');
    Route::get('/certificates/{id}',App\Http\Controllers\Site\Client\Certificate::class)->name('user.certificate')->withoutMiddleware(['auth']);
    Route::get('/exam/{token}',App\Http\Controllers\Site\Client\Exam::class)->name('user.exam');
    // Route::get('/homeworks',App\Http\Controllers\Site\Client\Homeworks::class)->name('user.homeworks');
    Route::get('/sample-questions',App\Http\Controllers\Site\Client\MySample::class)->name('user.sample');
});
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
    Route::get('/orders/{action}/{id?}',App\Http\Controllers\Admin\Orders\StoreOrder::class)->name('admin.store.order');
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
    // Route::get('/teachers',App\Http\Controllers\Admin\Teachers\IndexTeacher::class)->name('admin.teacher');
    // Route::get('/teachers/{action}/{id?}',App\Http\Controllers\Admin\Teachers\StoreTeacher::class)->name('admin.store.teacher');
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

    Route::get('/organizations',App\Http\Controllers\Admin\Organizations\IndexOrganization::class)->name('admin.organization');
    Route::get('/organizations/{action}/{id?}',App\Http\Controllers\Admin\Organizations\StoreOrganization::class)->name('admin.store.organization');
    Route::get('/executives',App\Http\Controllers\Admin\Executives\IndexExecutive::class)->name('admin.executive');
    Route::get('/executives/{action}/{id?}',App\Http\Controllers\Admin\Executives\StoreExecutive::class)->name('admin.store.executive');
    Route::get('/surveys',App\Http\Controllers\Admin\Surveys\IndexSurvey::class)->name('admin.survey');
    Route::get('/surveys/{action}/{id?}',App\Http\Controllers\Admin\Surveys\StoreSurvey::class)->name('admin.store.survey');

    Route::get('/samples',App\Http\Controllers\Admin\Samples\IndexSample::class)->name('admin.sample');
    Route::get('/samples/{action}/{id?}',App\Http\Controllers\Admin\Samples\StoreSample::class)->name('admin.store.sample');
});

Route::middleware('guest')->get('auth',App\Http\Controllers\Site\Auth\Auth::class)->name('auth');

Route::get('/logout', function (){
    Auth::logout();
    request()->session()->invalidate();
    request()->session()->regenerateToken();
    return redirect()->route('auth');
})->name('logout');
