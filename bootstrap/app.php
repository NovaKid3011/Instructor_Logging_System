<?php

use Illuminate\Foundation\Application;
use Illuminate\Foundation\Configuration\Exceptions;
use Illuminate\Foundation\Configuration\Middleware;

return Application::configure(basePath: dirname(__DIR__))
    ->withRouting(
        web: __DIR__.'/../routes/web.php',
        commands: __DIR__.'/../routes/console.php',
        health: '/up',
    )
    ->withMiddleware(function (Middleware $middleware) {
        $middleware->alias([
            'preventBackHistory'=>App\Http\Middleware\PreventBackHistory::class
        ]);
    })
    // ->withSchedule(function(Schedule $schedule) {
    //     $schedule->call(function() {
    //         Mail::to('sjaevoy@gmail.com')->send(new PostMail())
    //     })->dailyAt('18:15');
    // })
    ->withExceptions(function (Exceptions $exceptions) {
        //
    })->create();
