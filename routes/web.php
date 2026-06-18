<?php
use Illuminate\Support\Facades\Route;
use Mcamara\LaravelLocalization\Facades\LaravelLocalization;

Route::group(
    [
        'prefix' => LaravelLocalization::setLocale(),
        'as' => 'website.',
        'middleware' => ['localeSessionRedirect', 'localizationRedirect', 'localeViewPath'],
    ],
    function () {
        ###################################### welcome  ##################################################################
        Route::get('/', [\App\Http\Controllers\Website\HomeController::class, 'index'])->name('home');

        ###################################### routes  ##################################################################
    },
);

