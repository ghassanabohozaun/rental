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
        Route::get('/welcome', function () {
            return view('welcome');
        })
            ->where(['any' => '.*'])
            ->name('welcome');

        ###################################### routes  ##################################################################
    },
);
