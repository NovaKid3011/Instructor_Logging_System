<?php

use App\Mail\PostMail;
use Illuminate\Foundation\Inspiring;
use Illuminate\Support\Facades\Artisan;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Schedule;
use App\Models\Email;
use App\Models\User;

Artisan::command('inspire', function () {
    $this->comment(Inspiring::quote());
})->purpose('Display an inspiring quote')->hourly();

Schedule::command('app:clear-weekly-photo')->everyMinute();

Schedule::call(function() {
    $recipients = Email::all();
    $users = User::all();
    foreach($recipients as $recipient) {
        Mail::to($recipient->email)->send(new PostMail($users));
    }
})->everyMinute();

