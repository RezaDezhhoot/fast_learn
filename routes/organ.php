<?php

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;

Route::prefix('organs')->name('organ.')->middleware(['auth','organ'])->group(function(){
    Route::get('/dashboard', App\Http\Controllers\Organ\Dashboards\Dashboard::class)->name('dashboard');

    Route::get('/courses', App\Http\Controllers\Organ\Courses\IndexCourses::class)->name('courses');
    Route::get('/courses/new/{action}/{id}', App\Http\Controllers\Organ\Courses\StoreCourses::class)->name('new.courses');

    Route::get('/chapters',App\Http\Controllers\Organ\Chapters\IndexChapter::class)->name('chapters');
    Route::get('/chapters/{action?}/{id?}',App\Http\Controllers\Organ\Chapters\StoreChapter::class)->name('store.chapters');

    Route::get('/episodes', App\Http\Controllers\Organ\Episodes\IndexEpisode::class)->name('episodes');
    Route::get('/episodes/{action?}/{id?}', App\Http\Controllers\Organ\Episodes\StoreEpisode::class)->name('store.episodes');

    Route::get('/samples', App\Http\Controllers\Organ\Samples\IndexSample::class)->name('samples');
    Route::get('/samples/{action}/{id?}', App\Http\Controllers\Organ\Samples\StoreSample::class)->name('store.samples');


    Route::get('/roll-calls',App\Http\Controllers\Organ\RollCalls\IndexRollCall::class)->name('rollCall');
    Route::get('/roll-calls/{id?}',App\Http\Controllers\Organ\RollCalls\StoreRollCall::class)->name('store.rollCall');

    Route::get('/orders',App\Http\Controllers\Organ\Orders\IndexOrder::class)->name('order');

    Route::get('/bank-accounts', App\Http\Controllers\Organ\BankAccounts\IndexBankAccount::class)->name('bankAccounts');
    Route::get('/bank-accounts/{action}/{id?}', App\Http\Controllers\Organ\BankAccounts\StoreBankAccount::class)->name('store.bankAccounts');

    Route::get('/checkouts', App\Http\Controllers\Organ\Checkouts\IndexCheckout::class)->name('checkouts');
    Route::get('/checkouts/{action}/{id?}', App\Http\Controllers\Organ\Checkouts\StoreCheckout::class)->name('store.checkouts');
});
