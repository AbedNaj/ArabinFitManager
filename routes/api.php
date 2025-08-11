<?php

use App\Http\Middleware\CustomerViewPermission;
use Stancl\Tenancy\Middleware\InitializeTenancyByDomain;
use Stancl\Tenancy\Middleware\PreventAccessFromCentralDomains;
use Illuminate\Support\Facades\Route;

Route::middleware([
    'web',
    InitializeTenancyByDomain::class,
    PreventAccessFromCentralDomains::class,
])->group(function () {


    Route::middleware([
        CustomerViewPermission::class
    ])
        ->prefix('v1')
        ->as('api.')
        ->group(function () {
            Route::get('/customers', \App\Http\Controllers\Api\V1\Customers\CustomerSearchController::class)->name('customers.index');
        });
});
