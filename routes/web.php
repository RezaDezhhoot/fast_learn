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
Route::get('/storage/{episode}/{type}', App\Http\Controllers\StorageController::class)->name('storage');
Route::get('/',App\Http\Controllers\Site\Homes\Home::class)->name('home');
Route::get('/courses',App\Http\Controllers\Site\Courses\IndexCourse::class)->name('courses');
Route::get('/courses/{slug?}',App\Http\Controllers\Site\Courses\SingleCourse::class)->name('course');
Route::get('/articles',App\Http\Controllers\Site\Articles\IndexArticle::class)->name('articles');
Route::get('/articles/{slug?}',App\Http\Controllers\Site\Articles\SingleArticle::class)->name('article');
Route::get('/contact-us',App\Http\Controllers\Site\Settings\Contact::class)->name('contact');
Route::get('/about-us',App\Http\Controllers\Site\Settings\About::class)->name('about');
Route::get('/fag',App\Http\Controllers\Site\Settings\Fag::class)->name('fag');
Route::get('/cart',App\Http\Controllers\Site\Carts\Cart::class)->name('cart');
Route::get('/auth',App\Http\Controllers\Site\Auth\Auth::class)->name('auth');
Route::get('/teachers',App\Http\Controllers\Site\Teachers\IndexTeacher::class)->name('teachers');
Route::get('/teachers/{id}',App\Http\Controllers\Site\Teachers\SingleTeacher::class)->name('teacher');
Route::get('/codes/{code}',App\Http\Controllers\CodeController::class)->name('codes');
Route::get('/forms/{id}',\App\Http\Controllers\Site\Forms\FormPage::class)->name('form');
Route::get('/episodes/{course}/{chapter}/{episode}/{title}',\App\Http\Controllers\Site\Episodes\SingleEpisode::class)->name('episode');
// v2-samples
Route::get('/sample-questions',App\Http\Controllers\Site\Samples\IndexSample::class)->name('samples');
Route::get('/sample-questions/{slug}',App\Http\Controllers\Site\Samples\SingleSample::class)->name('sample');
// v3-teachers
Route::middleware(['auth','no_teacher'])->get('/apply',App\Http\Controllers\Site\Settings\TeacherRequest::class)->name('teacher.apply');

Route::get('/organ/{slug}',\App\Http\Controllers\Site\Organs\Organ::class)->name('organ');

Route::middleware(['auth'])->group(function (){
    Route::get('/checkout',App\Http\Controllers\Site\Carts\Checkout::class)->name('checkout');
    Route::get('/verify/{gateway?}',App\Http\Controllers\Site\Carts\Verify::class)->name('verify');
});

Route::middleware('guest')->get('auth',App\Http\Controllers\Site\Auth\Auth::class)->name('auth');

Route::get('/logout', function (){
    Auth::logout();
    request()->session()->invalidate();
    request()->session()->regenerateToken();
    return redirect()->route('auth');
})->name('logout');
