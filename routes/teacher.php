<?php

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Teacher Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/
// v3-teachers
Route::prefix('teacher')->name('teacher.')->middleware(['auth','role:teacher','teacher'])->group(function(){
    Route::get('/dashboard', App\Http\Controllers\Teacher\Dashboards\Dashboard::class)->name('dashboard');
    Route::get('/courses', App\Http\Controllers\Teacher\Courses\IndexCourse::class)->name('courses');
    Route::get('/courses/new/{action?}/{id?}', App\Http\Controllers\Teacher\Courses\StoreCourse::class)->name('new.courses');
    Route::get('/episodes', App\Http\Controllers\Teacher\Episodes\IndexEpisode::class)->name('episodes');
    Route::get('/episodes/{action}/{id?}', App\Http\Controllers\Teacher\Episodes\StoreEpisode::class)->name('store.episodes');
    Route::get('/checkouts', App\Http\Controllers\Teacher\Checkouts\IndexCheckout::class)->name('checkouts');
    Route::get('/checkouts/{action}/{id?}', App\Http\Controllers\Teacher\Checkouts\StoreCheckout::class)->name('store.checkouts');
    Route::get('/comments', App\Http\Controllers\Teacher\Comments\IndexComment::class)->name('comments');
    Route::get('/comments/{action}/{id?}', App\Http\Controllers\Teacher\Comments\StoreComment::class)->name('store.comments');
    Route::get('/bank-accounts', App\Http\Controllers\Teacher\BankAccounts\IndexBankAccount::class)->name('bankAccounts');
    Route::get('/bank-accounts/{action}/{id?}', App\Http\Controllers\Teacher\BankAccounts\StoreBankAccount::class)->name('store.bankAccounts');
    Route::get('/quizzes', App\Http\Controllers\Teacher\Quizzes\IndexQuiz::class)->name('quizzes');
    Route::get('/quizzes/{action}/{id?}', App\Http\Controllers\Teacher\Quizzes\StoreQuiz::class)->name('store.quizzes');
    Route::get('/questions', App\Http\Controllers\Teacher\Questions\IndexQuestion::class)->name('questions');
    Route::get('/questions/{action}/{id?}', App\Http\Controllers\Teacher\Questions\StoreQuestion::class)->name('store.questions');
    Route::get('/transcripts', App\Http\Controllers\Teacher\Transcripts\IndexTranscript::class)->name('transcripts');
    Route::get('/transcripts/{action}/{id?}', App\Http\Controllers\Teacher\Transcripts\StoreTranscript::class)->name('store.transcripts');
    Route::get('/samples', App\Http\Controllers\Teacher\Samples\IndexSamples::class)->name('samples');
    Route::get('/samples/{action}/{id?}', App\Http\Controllers\Teacher\Samples\StoreSamples::class)->name('store.samples');
});
