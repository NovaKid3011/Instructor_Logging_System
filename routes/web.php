<?php

use App\Http\Controllers\AdminController;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\ReportController;
use App\Http\Controllers\InstructorController;
use App\Http\Controllers\SearchController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\MailController;
use App\Http\Controllers\LoggerController;
use App\Livewire\Counter;

Route::middleware('preventBackHistory')->group(function () {
    Route::get('/', [AuthController::class, 'login'])->name('login');
    Route::get('/login', [AuthController::class, 'login'])->name('login');
    Route::post('/login', [AuthController::class, 'loginPost'])->name('login.post');
    Route::get('/register', [AuthController::class, 'register'])->name('register');
    Route::post('/register', [AuthController::class, 'registerPost'])->name('register.post');
});

Route::get('/logout', [AuthController::class, 'logout'])->name('logout');




Route::middleware(['preventBackHistory'])->group(function () {
    Route::prefix('user')->group(function () {
        Route::get('/table', [UserController::class, 'table'])->name('table');
        Route::get('/table/schedule/{instructorId}', [UserController::class, 'schedule'])->name('sched');
        Route::post('/table/schedule/{instructorId}/upload/{scheduleId}', [UserController::class, 'store'])->name('sched.upload');
        Route::get('/instructors/letter/{alpha}', [InstructorController::class, 'showByLetter'])->name('instructors.by_letter');
        Route::get('/user/schedule/{id}', [UserController::class, 'schedule'])->name('user.sched');
    });

    Route::prefix('admin')->group(function () {
        Route::get('/dashboard', [AuthController::class, 'dashboard'])->name('dashboard');

        Route::prefix('dashboard')->group(function () {

            Route::get('/profile', [AdminController::class, 'profile'])->name('profile');
            Route::get('/users', [AdminController::class, 'users'])->name('users');
            Route::post('/users/create', [AdminController::class, 'create'])->name('user.create');
            Route::delete('/delete/{id}', [AdminController::class, 'destroy'])->name('user.delete');
            Route::put('/users/update/{id}', [AdminController::class, 'update'])->name('user.update');
            Route::get('/instructor', [InstructorController::class, 'index'])->name('instructor');
            Route::get('/instructor-monthly/{id}', [InstructorController::class, 'instructorMonthly'])->name('instructor.monthly');
            Route::get('/instructor/monthly-report', [InstructorController::class, 'monthlyReport'])->name('instructor.monthly_report');

            Route::get('/settings/loggers', [LoggerController::class, 'index'])->name('loggers');
            Route::post('/settings/loggers', [LoggerController::class, 'selection'])->name('selectedIds');


            Route::post('/mail', [MailController::class, 'getEmail'])->name('getEmail');
            Route::get('/mail', [MailController::class, 'sendMail'])->name('mail');
            Route::get('/report', [ReportController::class, 'index'])->name('report');
            // Route::get('/download-csv', [ReportController::class, 'dailyReport'])->name('report.daily_report');


            Route::get('/report/daily-report', [ReportController::class, 'dailyReport'])->name('report.daily_report');
            Route::get('/report/monthly-report', [ReportController::class, 'monthlyReport'])->name('report.monthly_report');

});

            Route::get('/schedules', [InstructorController::class, 'schedules'])->name('schedules');
            Route::get('/manage-email', [MailController::class, 'index'])->name('manage-emails');
            Route::post('/manage-email', [MailController::class, 'registerMail'])->name('add-email');
            Route::put('/manage-email/{id}', [MailController::class, 'editMail'])->name('editMail');
            Route::delete('/delete-email/{id}', [MailController::class, 'deleteEmail'])->name('email-delete');


            Route::get('/report', [ReportController::class, 'index'])->name('report');
            // Route::get('/download-csv', [ReportController::class, 'dailyReport'])->name('report.daily_report');
            Route::get('/report/daily-report', [ReportController::class, 'dailyReport'])->name('report.daily_report');
            Route::get('/report/monthly-report', [ReportController::class, 'monthlyReport'])->name('report.monthly_report');

            });

        });




Route::get('/search', [SearchController::class, 'index'])->name('search');
