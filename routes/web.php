<?php

use App\Http\Controllers\admin\auth\LoginController;
use Illuminate\Support\Facades\Route;


foreach (config('tenancy.central_domains') as $domain) {
    Route::domain($domain)->group(function () {



        Route::get('/dashboard', function () {
            return view('superAdmin.dashboard');
        })->middleware('auth')->name('dashboard');



        Route::controller(LoginController::class)->middleware('guest')->group(function () {
            Route::get('/login', 'show')->name('login');
            Route::post('/login', 'store')->name('login.store');
        });
    });
}
