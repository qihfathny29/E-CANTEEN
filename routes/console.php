<?php

use Illuminate\Foundation\Inspiring;
use Illuminate\Support\Facades\Artisan;
use Illuminate\Support\Facades\Schedule;

Artisan::command('inspire', function () {
    $this->comment(Inspiring::quote());
})->purpose('Display an inspiring quote');

// Reset stok menu yang habis ke 50 porsi setiap hari jam 05:00 pagi
Schedule::command('menu:reset-stock --default=50')->dailyAt('05:00');
