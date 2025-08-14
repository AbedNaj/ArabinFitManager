<?php

declare(strict_types=1);

use App\Http\Controllers\Admin\Auth\LoginController;
use App\Http\Controllers\Admin\CustomerController;
use App\Http\Controllers\Admin\DashboardController;
use App\Http\Controllers\Admin\DebtController;
use App\Http\Controllers\Admin\PlanController;
use App\Http\Controllers\Admin\RegistrationController;
use App\Http\Middleware\Auth\TenantLoginCheck;
use App\Http\Middleware\CustomerViewPermission;
use Illuminate\Support\Facades\Route;
use Stancl\Tenancy\Middleware\InitializeTenancyByDomain;
use Stancl\Tenancy\Middleware\PreventAccessFromCentralDomains;

/*
|--------------------------------------------------------------------------
| Tenant Routes
|--------------------------------------------------------------------------
|
| Here you can register the tenant routes for your application.
| These routes are loaded by the TenantRouteServiceProvider.
|
| Feel free to customize them however you want. Good luck!
|
*/

Route::middleware([
    'web',
    InitializeTenancyByDomain::class,
    PreventAccessFromCentralDomains::class,

])->group(function () {
    Route::get('/', function () {
        return 'This is your multi-tenant application. The id of the current tenant is ' . tenant('id');
    });
    Route::prefix('admin/')->name('admin.')->group(function () {
        Route::controller(LoginController::class)->group(function () {
            Route::get('/login', 'index')->name('login.index');
            Route::post('/login', 'store')->name('login.store');
        });

        Route::middleware(TenantLoginCheck::class)->group(function () {
            Route::get('/dashboard', DashboardController::class)->name('dashboard');

            Route::controller(CustomerController::class)->middleware(CustomerViewPermission::class)->name('customers.')->group(function () {
                Route::get('/customers', 'index')->name('index');
                Route::get('/customers/create', 'create')->name('create');
                Route::post('/customers', 'store')->name('store');
                Route::get('/customers/{customer}', 'show')->name('show');
                Route::patch('/customers/{customer}', 'update')->name('update');
            });


            Route::controller(PlanController::class)->name('plans.')->group(function () {
                Route::get('/plans', 'index')->name('index');
                Route::get('/plans/create', 'create')->name('create');
                Route::post('/plans', 'store')->name('store');
                Route::get('/plans/{plan}', 'show')->name('show');
                Route::patch('/plans/{plan}', 'update')->name('update');
                Route::delete('/plans/{plan}', 'destroy')->name('delete');
            });

            Route::controller(RegistrationController::class)->name('registrations.')->group(function () {
                Route::get('/registrations', 'index')->name('index');
                Route::get('/registrations/create', 'create')->name('create');
                Route::post('/registrations', 'store')->name('store');
                Route::get('/registrations/{registration}', 'show')->name('show');
                Route::patch('/registrations/{registration}', 'update')->name('update');
                Route::delete('/registrations/{registration}', 'destroy')->name('delete');
            });

            Route::controller(DebtController::class)->name('debts.')->group(function () {
                Route::get('/debts', 'index')->name('index');
                Route::get('/debts/create', 'create')->name('create');

                Route::get('/debts/{debt}', 'show')->name('show');
                Route::patch('/debts/{debt}', 'update')->name('update');
                Route::delete('/debts/{debt}', 'destroy')->name('delete');
            });
        });
    });
});
