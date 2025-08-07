<?php

declare(strict_types=1);

use App\Http\Controllers\Admin\Auth\LoginController;
use App\Http\Controllers\Admin\CustomerController;
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

        Route::middleware('auth:tenant')->group(function () {
            Route::get('/dashboard', function () {
                return view('admin.pages.dashboard');
            })->name('dashboard');

            Route::controller(CustomerController::class)->name('customers.')->group(function () {
                Route::get('/customers', 'index')->name('index');
                Route::get('/customers/create', 'create')->name('create');
                Route::post('/customers', 'store')->name('store');
                Route::get('/customers/{customer}', 'show')->name('show');
                Route::patch('/customers/{customer}', 'update')->name('update');
            });
        });
    });
});
