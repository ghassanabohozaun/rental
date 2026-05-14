<?php

use App\Http\Controllers\Dashboard\Auth\AuthController;
use App\Http\Controllers\Dashboard\Auth\Passowrd\ForgetPasswordController;
use App\Http\Controllers\Dashboard\Auth\Passowrd\ResetPasswordController;
use App\Http\Controllers\Dashboard\{CompaniesController,CompanyBankAccountController, DashboardController, DepartmentsController, RolesController, SettingsController, UsersController, PropertyTypesController, PropertyStatusesController, PropertyController, OwnersController, GuarantorsController, CustomersController, MaintenancesController, ContractsController, ChequesController, PaymentsController};
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
        ########################################### Auth  #################################################################################
        Route::get('login', [AuthController::class, 'getLogin'])->name('get.login');
        Route::post('login', [AuthController::class, 'postLogin'])->name('post.login');
        Route::get('logout', [AuthController::class, 'logout'])->name('logout');
        ########################################### reset password  #######################################################################


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
        Route::group(['middleware' => ['auth:web', 'checkLockScreen']], function () {
            ########################################### Auth Protected ####################################################################
            Route::get('lock-screen', [AuthController::class, 'lockScreen'])->name('lock.screen');
            Route::post('unlock-screen', [AuthController::class, 'unlock'])->name('unlock.screen');

            ########################################### welcome  ##########################################################################
            Route::get('/welcome', [DashboardController::class, 'index'])->name('index');

            ########################################### roles routes ######################################################################
            Route::group(['middleware' => 'can:roles_read'], function () {
                Route::resource('roles', RolesController::class);
                Route::post('/roles/destroy', [RolesController::class, 'destroy'])->name('roles.destroy');
            });

            ########################################### users routes  #####################################################################
            Route::group(['middleware' => 'can:users_read'], function () {
                Route::resource('users', UsersController::class);
                Route::post('/users/destroy', [UsersController::class, 'destroy'])->name('users.destroy');
                Route::post('/users/status', [UsersController::class, 'changeStatus'])->name('users.change.status');
            });

            ########################################### settings routes  ###################################################################
            Route::group(['middleware' => 'can:settings_read'], function () {
                Route::get('/settings', [SettingsController::class, 'index'])->name('settings.index');
                Route::put('/settings/{id?}', [SettingsController::class, 'update'])->name('settings.update');
            });

            ########################################### employee routes  #################################################################
            Livewire::setUpdateRoute(function ($handle) {
                return Route::match(['get', 'post'], '/livewire/update', $handle);
            });

            ########################################### departments routes  ##############################################################
            Route::group(['middleware' => 'can:departments_read'], function () {
                Route::resource('departments', DepartmentsController::class);
                Route::post('/departments/destroy', [DepartmentsController::class, 'destroy'])->name('departments.destroy');
                Route::post('/departments/status', [DepartmentsController::class, 'changeStatus'])->name('departments.change.status');
            });

            ########################################### companies routes  ##############################################################
            Route::group(['middleware' => 'can:companies_read'], function () {
                Route::resource('companies', CompaniesController::class);
                Route::post('/companies/destroy', [CompaniesController::class, 'destroy'])->name('companies.destroy');
                Route::post('/companies/status', [CompaniesController::class, 'updateStatus'])->name('companies.status');
                Route::get('/companies-autocomplete', [CompaniesController::class, 'autocomplete'])->name('companies.autocomplete');
            });
            ########################################### bank accounts routes #############################################################
            Route::group(['middleware' => 'can:bank_accounts_read'], function () {
                Route::resource('bank-accounts', CompanyBankAccountController::class);
                Route::post('/bank-accounts/destroy', [CompanyBankAccountController::class, 'destroy'])->name('bank-accounts.destroy');
            });
            ########################################### properties routes #############################################################
            Route::group(['middleware' => 'can:properties_read'], function () {
                Route::resource('properties', PropertyController::class);
                Route::post('/properties/destroy', [PropertyController::class, 'destroy'])->name('properties.destroy');
                Route::get('/properties-autocomplete', [PropertyController::class, 'autocomplete'])->name('properties.autocomplete');
            });

            ########################################### property types routes #############################################################
            Route::group(['middleware' => 'can:property_types_read'], function () {
                Route::resource('property_types', PropertyTypesController::class);
                Route::post('/property_types/destroy', [PropertyTypesController::class, 'destroy'])->name('property_types.destroy');
                Route::post('/property_types/status', [PropertyTypesController::class, 'changeStatus'])->name('property_types.change.status');
                Route::get('/property_types-autocomplete', [PropertyTypesController::class, 'autocomplete'])->name('property_types.autocomplete');
            });

            ########################################### property statuses routes #############################################################
            Route::group(['middleware' => 'can:property_statuses_read'], function () {
                Route::resource('property_statuses', PropertyStatusesController::class);
                Route::post('/property_statuses/destroy', [PropertyStatusesController::class, 'destroy'])->name('property_statuses.destroy');
                Route::post('/property_statuses/status', [PropertyStatusesController::class, 'changeStatus'])->name('property_statuses.change.status');
                Route::get('/property_statuses-autocomplete', [PropertyStatusesController::class, 'autocomplete'])->name('property_statuses.autocomplete');
            });

            ########################################### guarantors routes #############################################################
            Route::group(['middleware' => 'can:guarantors_read'], function () {
                Route::resource('guarantors', GuarantorsController::class);
                Route::post('/guarantors/destroy', [GuarantorsController::class, 'destroy'])->name('guarantors.destroy');
                Route::post('/guarantors/status', [GuarantorsController::class, 'changeStatus'])->name('guarantors.change.status');
                Route::get('/guarantors-autocomplete', [GuarantorsController::class, 'autocomplete'])->name('guarantors.autocomplete');
            });

            ########################################### owners routes #############################################################
            Route::group(['middleware' => 'can:owners_read'], function () {
                Route::resource('owners', OwnersController::class);
                Route::post('/owners/destroy', [OwnersController::class, 'destroy'])->name('owners.destroy');
                Route::get('/owners-autocomplete', [OwnersController::class, 'autocomplete'])->name('owners.autocomplete');
                Route::get('/owners-by-company', [OwnersController::class, 'getByCompany'])->name('owners.by-company');
            });

            ########################################### customers routes #############################################################
            Route::group(['middleware' => 'can:customers_read'], function () {
                Route::resource('customers', CustomersController::class);
                Route::post('/customers/destroy', [CustomersController::class, 'destroy'])->name('customers.destroy');
                Route::post('/customers/status', [CustomersController::class, 'changeStatus'])->name('customers.change.status');
                Route::get('/customers-autocomplete', [CustomersController::class, 'autocomplete'])->name('customers.autocomplete');
            });

            ########################################### maintenances routes #############################################################
            Route::group(['middleware' => 'can:maintenances_read'], function () {
                Route::resource('maintenances', MaintenancesController::class);
                Route::post('/maintenances/destroy', [MaintenancesController::class, 'destroy'])->name('maintenances.destroy');
                Route::post('/maintenances/status', [MaintenancesController::class, 'changeStatus'])->name('maintenances.change.status');
            });

            ########################################### contracts routes #############################################################
            Route::group(['middleware' => 'can:contracts_read'], function () {
                Route::resource('contracts', ContractsController::class);
                Route::post('/contracts/destroy', [ContractsController::class, 'destroy'])->name('contracts.destroy');
                Route::get('/contracts-autocomplete', [ContractsController::class, 'autocomplete'])->name('contracts.autocomplete');
                Route::get('/contracts/{id}/payments', [ContractsController::class, 'getPayments'])->name('contracts.payments');
                Route::get('/contracts/{id}/cheques', [ContractsController::class, 'getCheques'])->name('contracts.cheques');
            });

            ########################################### cheques routes #############################################################
            Route::group(['middleware' => 'can:cheques_read'], function () {
                Route::resource('cheques', ChequesController::class);
                Route::post('/cheques/destroy', [ChequesController::class, 'destroy'])->name('cheques.destroy');
                Route::get('/cheques-autocomplete', [ChequesController::class, 'autocomplete'])->name('cheques.autocomplete');
                Route::get('/cheques/contract-details/{id}', [ChequesController::class, 'getContractDetails'])->name('cheques.contract-details');
                Route::post('/cheques/{id}/return', [ChequesController::class, 'returnCheque'])->name('cheques.return');
                Route::post('/cheques/{id}/cash', [ChequesController::class, 'cashCheque'])->name('cheques.cash');
            });

            ########################################### payments routes #############################################################
            Route::group(['middleware' => 'can:payments_read'], function () {
                Route::resource('payments', PaymentsController::class);
                Route::post('/payments/destroy', [PaymentsController::class, 'destroy'])->name('payments.destroy');
                Route::get('/payments/contract-details/{id}', [PaymentsController::class, 'getContractDetails'])->name('payments.contract-details');
            });
        });
    },
);

