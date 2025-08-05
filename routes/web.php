<?php

use App\Http\Controllers\SuperAdmin\Auth\LoginController;
use App\Http\Controllers\SuperAdmin\TenantController;
use Illuminate\Support\Facades\Route;


foreach (config('tenancy.central_domains') as $domain) {
    Route::domain($domain)->group(function () {





        Route::controller(LoginController::class)->middleware('guest')->group(function () {
            Route::get('/login', 'show')->name('login');
            Route::post('/login', 'store')->name('login.store');
        });



        Route::middleware('auth')->group(function () {
            Route::get('/dashboard', function () {
                return view('superAdmin.dashboard');
            })->name('dashboard');


            Route::controller(TenantController::class)->name('gyms.')->group(function () {

                Route::get('/gyms', 'index')->name('index');

                Route::get('/gyms/create', 'create')->name('create');
                Route::post('/gyms/store', 'store')->name('store');
            });
        });
    });
}
