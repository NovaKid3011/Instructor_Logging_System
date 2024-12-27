<?php

use App\Mail\PostMail;
use Illuminate\Foundation\Inspiring;
use Illuminate\Support\Facades\Artisan;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Schedule;

Artisan::command('inspire', function () {
    $this->comment(Inspiring::quote());
})->purpose('Display an inspiring quote')->hourly();

Schedule::command('app:clear-weekly-photo')->everyMinute();

Schedule::call(function() {
    Mail::to('admin@example.com')->send(new PostMail());
})->everyMinute();

