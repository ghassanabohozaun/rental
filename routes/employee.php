<?php

use App\Http\Controllers\Employees\Auth\AuthController;
use App\Http\Controllers\Employees\DailyReportsController;
use App\Http\Controllers\Employees\EmployeesController;
use App\Http\Controllers\Employees\EmployeeTaskController;
use App\Http\Controllers\Employees\MessagesController;
use App\Http\Controllers\Employees\MonthlyReportsController;
use App\Http\Controllers\Employees\OverviewController;
use Illuminate\Support\Facades\Route;
use Livewire\Livewire;
use Mcamara\LaravelLocalization\Facades\LaravelLocalization;

Route::group(
    [
        'prefix' => LaravelLocalization::setLocale() . '/employees',
        'as' => 'employees.',
        'middleware' => ['localeSessionRedirect', 'localizationRedirect', 'localeViewPath'],
    ],
    function () {
        ###################################### Auth  ##################################################################
        Route::get('login', [AuthController::class, 'getLogin'])->name('get.login');
        Route::post('login', [AuthController::class, 'postLogin'])->name('post.login');
        Route::get('logout', [AuthController::class, 'logout'])->name('logout');

        ########################################### Livewire routes ################################################################

        Livewire::setUpdateRoute(function ($handle) {
            return Route::match(['get', 'post'], '/livewire/update', $handle);
        });

        ########################################### employees routes  ######################################################################
        Route::group(['middleware' => 'auth:employee'], function () {
            ########################################### overview routes  ######################################################################
            Route::get('/overview', [OverviewController::class, 'index'])->name('overview');
            Route::post('/overview/change/password', [OverviewController::class, 'changeEmployeePassword'])->name('overview.change.password');
            Route::get('/overview/contracts/data', [OverviewController::class, 'getContractsData'])->name('overview.contracts.data');

            ########################################### employees routes  ######################################################################
            Route::resource('employees', EmployeesController::class);

            ########################################### daily reports routes  ######################################################################
            Route::resource('dailyReports', DailyReportsController::class);
            Route::post('/dailyReports/destroy', [DailyReportsController::class, 'destroy'])->name('daily.reports.destroy');
            Route::get('/dailyReports/status/{id?}', [DailyReportsController::class, 'changeStatus'])->name('daliy.reports.change.status');

            ########################################### monthly reports routes  ######################################################################
            Route::resource('monthlyReports', MonthlyReportsController::class);
            Route::post('/monthlyReports/destroy', [MonthlyReportsController::class, 'destroy'])->name('monthly.reports.destroy');

            Route::get('/monthlyReports/status/{id?}', [MonthlyReportsController::class, 'changeStatus'])->name('monthly.reports.change.status');

            ########################################### messages routes ######################################################################
            Route::get('/messages', [MessagesController::class, 'index'])->name('messages.index');

            ########################################### tasks routes ######################################################################
            Route::get('/tasks', [EmployeeTaskController::class, 'index'])->name('tasks.index');
        });
    },
);
