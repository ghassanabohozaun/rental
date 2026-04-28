<?php

use App\Http\Controllers\Dashboard\Auth\AuthController;
use App\Http\Controllers\Dashboard\Auth\Password\ForgetPasswordController;
use App\Http\Controllers\Dashboard\Auth\Password\ResetPasswordController;
use App\Http\Controllers\Dashboard\CategoriesController;
use App\Http\Controllers\Dashboard\CountriesController;
use App\Http\Controllers\Dashboard\FlightsController;
use App\Http\Controllers\Dashboard\ReservationsController;
use App\Http\Controllers\Dashboard\ToursController;
use App\Http\Controllers\Dashboard\WeatherController;
use App\Http\Controllers\Dashboard\{AdminsController, CitiesController, DashboardController, DepartmentsController, GovernoratiesController, PagesController, ProfileController, RolesController, SettingsController, SlidersController, TasksController, FlightTicketsController, MailingBoxController, NotificationsController};
use App\Http\Middleware\CheckLockScreen;
use Illuminate\Support\Facades\Route;
use Livewire\Livewire;
use Mcamara\LaravelLocalization\Facades\LaravelLocalization;

Route::group(
    [
        'prefix' => LaravelLocalization::setLocale() . '/dashboard',
        'as' => 'dashboard.',
        'middleware' => ['localeSessionRedirect', 'localizationRedirect', 'localeViewPath'],
    ],
    function () {
        ########################################### Auth (Guest) ###########################################################
        Route::get('login', [AuthController::class, 'getLogin'])->name('get.login');
        Route::post('login', [AuthController::class, 'postLogin'])->name('post.login');
        Route::get('logout', [AuthController::class, 'logout'])->name('logout');
        ########################################### reset password  ######################################################################
        Route::group(['prefix' => 'password', 'as' => 'password.'], function () {
            Route::controller(ForgetPasswordController::class)->group(function () {
                Route::get('email', 'showEmailForm')->name('get.email');
                Route::post('email', 'sendOTP')->name('post.email');
                Route::get('verify/{email?}', 'showVerifyOTPForm')->name('verify');
                Route::post('verify', 'verifyOTP')->name('post.verify');
            });

            Route::controller(ResetPasswordController::class)->group(function () {
                Route::get('reset/{email?}', 'showResetFrom')->name('reset');
                Route::post('reset', 'resetPasword')->name('post.reset');
            });
        });

        ########################################### protected routes  #####################################################################
        Route::group(['middleware' => ['auth:admin', CheckLockScreen::class]], function () {
            ########################################### Auth Protected #######################################################
            Route::get('lock-screen', [AuthController::class, 'lockScreen'])->name('lock.screen');
            Route::post('unlock-screen', [AuthController::class, 'unlock'])->name('unlock.screen');

            ########################################### home  ##########################################################################
            Route::get('/home', [DashboardController::class, 'index'])->name('index');

            ########################################### profile  routes ##########################################################################
            Route::get('/profile', [ProfileController::class, 'index'])->name('profile.index');
            Route::post('/profile/change-password', [ProfileController::class, 'changePassword'])->name('profile.change.password');

            Route::group(['middleware' => 'can:settings'], function () {
                Route::get('/settings', [SettingsController::class, 'index'])->name('settings.index');
                Route::put('/settings/{id?}', [SettingsController::class, 'update'])->name('settings.update');

                // about us routes
                Route::get('/about-us', [\App\Http\Controllers\Dashboard\AboutUsController::class, 'edit'])->name('about_us.edit');
                Route::post('/about-us', [\App\Http\Controllers\Dashboard\AboutUsController::class, 'update'])->name('about_us.update');

                // about us timeline routes
                Route::resource('about-us-timeline', \App\Http\Controllers\Dashboard\AboutUsTimelineController::class)->except(['show']);
                Route::post('/about-us-timeline/destroy', [\App\Http\Controllers\Dashboard\AboutUsTimelineController::class, 'destroy'])->name('about-us-timeline.destroy');
            });

            ########################################### roles routes ######################################################################
            Route::group(['middleware' => 'can:roles'], function () {
                Route::resource('roles', RolesController::class)->except(['destroy']);
                Route::post('/roles/destroy', [RolesController::class, 'destroy'])->name('roles.destroy');
            });

            ########################################### admins routes  #####################################################################
            Route::group(['middleware' => 'can:admins'], function () {
                Route::resource('admins', AdminsController::class)->except(['destroy']);
                Route::post('/admins/destroy', [AdminsController::class, 'destroy'])->name('admins.destroy');
                Route::post('/admins/status', [AdminsController::class, 'changeStatus'])->name('admins.change.status');
            });

            ########################################### tasks routes ######################################################################
            Route::group(['middleware' => 'can:tasks'], function () {
                Route::get('/tasks', [TasksController::class, 'index'])->name('tasks.index');
            });
            ########################################### addresses routes  ######################################################################
            Route::group(['as' => 'addresses.', 'middleware' => 'can:addresses'], function () {
                // countries routes
                Route::resource('countries', CountriesController::class)->except(['destroy']);
                Route::post('/countries/destroy', [CountriesController::class, 'destroy'])->name('countries.destroy');
                Route::post('/countries/status', [CountriesController::class, 'changeStatus'])->name('countries.change.status');
                Route::get('/country/{country_id?}/cities', [CountriesController::class, 'getAllCitiesByCountry'])->name('countries.get.cities.by.country.id');
                Route::get('/countries/autocomplete/country', [CountriesController::class, 'autocompleteCountry'])->name('countries.autocomplete.country');

                // cities routes
                Route::resource('cities', CitiesController::class)->except(['destroy']);
                Route::post('/cities/destroy', [CitiesController::class, 'destroy'])->name('cities.destroy');
                Route::get('/cities/autocomplete/city', [CitiesController::class, 'autocompleteCity'])->name('cities.autocomplete.city');
            });

            ########################################### employee routes  ######################################################################
            Livewire::setUpdateRoute(function ($handle) {
                return Route::post('/livewire/update', $handle);
            });
            ########################################### sliders routes  ######################################################################
            Route::group(['middleware' => 'can:sliders'], function () {
                Route::resource('sliders', SlidersController::class)->except(['destroy']);
                Route::post('/sliders/destroy', [SlidersController::class, 'destroy'])->name('sliders.destroy');
                Route::post('/sliders/status', [SlidersController::class, 'changeStatus'])->name('sliders.change.status');
            });

            ########################################### pages routes  ######################################################################
            Route::group(['middleware' => 'can:pages'], function () {
                Route::resource('pages', PagesController::class)->except(['destroy']);
                Route::get('/pages/get/all', [PagesController::class, 'getAll'])->name('pages.get.all');
                Route::post('/pages/destroy/{id?}', [PagesController::class, 'destroy'])->name('pages.destroy');
                Route::post('/pages/status', [PagesController::class, 'changeStatus'])->name('pages.change.status');
            });

            ########################################### tickets routes  ####################################################################
            Route::group(['middleware' => 'can:tickets'], function () {
                Route::resource('tickets', FlightTicketsController::class)->except(['destroy']);
                Route::get('/tickets/get/all', [FlightTicketsController::class, 'getAll'])->name('tickets.get.all');
                Route::get('/tickets/export', [FlightTicketsController::class, 'export'])->name('tickets.export');
                Route::post('/tickets/destroy', [FlightTicketsController::class, 'destroy'])->name('tickets.destroy');
                Route::post('/tickets/status', [FlightTicketsController::class, 'changeStatus'])->name('tickets.change.status');
            });

            ########################################### tours  ######################################################################
            Route::group(['middleware' => 'can:tours'], function () {
                Route::resource('tours', ToursController::class)->except(['destroy']);
                Route::post('/tours/destroy/{id?}', [ToursController::class, 'destroy'])->name('tours.destroy');
                Route::get('/tours-all', [ToursController::class, 'getAll'])->name('tours.get.all');
                Route::post('/tours/change-status', [ToursController::class, 'changeStatus'])->name('tours.change.status');
                Route::get('/tours/export', [ToursController::class, 'export'])->name('tours.export');
            });

            ########################################### reservations  ###############################################################
            Route::group(['middleware' => 'can:reservations'], function () {
                Route::resource('reservations', ReservationsController::class)->except(['destroy']);
                Route::post('/reservations/destroy', [ReservationsController::class, 'destroy'])->name('reservations.destroy');
                Route::get('/reservations/show/report', [ReservationsController::class, 'showReport'])->name('reservations.show.report');
                Route::post('/reservations/export/excel', [ReservationsController::class, 'exportExcel'])->name('reservations.export.excel');
            });

            ########################################### flights  ######################################################################
            Livewire::setUpdateRoute(function ($handle) {
                return Route::post('/livewire/update', $handle);
            });

            Route::group(['middleware' => 'can:flights'], function () {
                Route::resource('flights', FlightsController::class)->except(['destroy']);
                Route::post('/flights/destroy', [FlightsController::class, 'destroy'])->name('flights.destroy');
                Route::get('/flights-all', [FlightsController::class, 'getAll'])->name('flights.get.all');
                Route::post('/flights/change-status', [FlightsController::class, 'changeStatus'])->name('flights.change.status');
                Route::get('/children/get-cities/{id?}', [FlightsController::class, 'getCities'])->name('flights.get.cities');
            });

            ########################################### categories routes  ##########################################################
            Route::group(['middleware' => 'can:categories'], function () {
                Route::resource('categories', CategoriesController::class)->except(['show', 'edit']);
                Route::get('/categories-all', [CategoriesController::class, 'getAll'])->name('categories.all');
                Route::post('/categories/destroy', [CategoriesController::class, 'destroy'])->name('categories.destroy');
                Route::post('/categories/status', [CategoriesController::class, 'changeStatus'])->name('categories.change.status');
                Route::get('/categories/getFlights/{category_id?}', [CategoriesController::class, 'getFlights'])->name('categories.get.flights');
                Route::get('categories/flight-paginate', [CategoriesController::class, 'flightPaging'])->name('categories.flights.paging');
            });

            ########################################### notifications routes  ###############################################################
            Route::group(['middleware' => 'can:notifications'], function () {
                Route::get('/notifications', [NotificationsController::class, 'index'])->name('notifications.index');
                Route::post('/notifications/store', [NotificationsController::class, 'store'])->name('notifications.store');
                Route::post('/notifications/destroy/{id?}', [NotificationsController::class, 'destroy'])->name('notifications.destroy');
                Route::post('/notifications/status', [NotificationsController::class, 'changeStatus'])->name('notifications.changeStatus');
            });

            ########################################### mailing routes  ####################################################################
            Route::group(['middleware' => 'can:mailing'], function () {
                Route::get('/mailing', [MailingBoxController::class, 'index'])->name('mailing.index');
                Route::post('/mailing/store', [MailingBoxController::class, 'store'])->name('mailing.store');
                Route::post('/mailing/destroy/{id?}', [MailingBoxController::class, 'destroy'])->name('mailing.destroy');
                Route::post('/mailing/status', [MailingBoxController::class, 'changeStatus'])->name('mailing.changeStatus');
            });

            ########################################### weather routes  ####################################################################
            Route::get('/weather', [WeatherController::class, 'index'])->name('weather.index');
        });
    },
);
