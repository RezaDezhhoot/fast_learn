<?php

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Client Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/
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
    Route::get('/certificates/{id}',App\Http\Controllers\Site\Client\Certificate::class)->name('user.certificate');
    Route::get('/exam/{token}',App\Http\Controllers\Site\Client\Exam::class)->name('user.exam');
    Route::get('/homeworks',App\Http\Controllers\Site\Client\Homeworks::class)->name('user.homeworks');
    // v2-samples
    Route::get('/sample-questions',App\Http\Controllers\Site\Client\MySample::class)->name('user.sample');
    // v3-teachers
    Route::get('/requests',App\Http\Controllers\Site\Client\Requests::class)->name('user.requests');

    Route::get('/organs/requests',App\Http\Controllers\Site\Client\OrganRequest::class)->name('user.organ.request');
});
