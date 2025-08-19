<?php

use Illuminate\Foundation\Inspiring;
use Illuminate\Support\Facades\Artisan;
use Illuminate\Support\Facades\Schedule;

Schedule::command('tenants:run', [
    'registration:expired',
])
    ->daily()
    ->withoutOverlapping();

Schedule::command('tenants:run', [
    'registration:active',
])
    ->daily()
    ->withoutOverlapping();
