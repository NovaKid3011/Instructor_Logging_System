<?php

use App\Http\Controllers\AdminController;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\ReportController;
use App\Http\Controllers\InstructorController;
use App\Http\Controllers\SearchController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\MailController;

Route::middleware('preventBackHistory')->group(function () {
    Route::get('/', [AuthController::class, 'login'])->name('login');
    Route::get('/login', [AuthController::class, 'login'])->name('login');
    Route::post('/login', [AuthController::class, 'loginPost'])->name('login.post');
    Route::get('/register', [AuthController::class, 'register'])->name('register');
    Route::post('/register', [AuthController::class, 'registerPost'])->name('register.post');
});

Route::get('/logout', [AuthController::class, 'logout'])->name('logout');


Route::get('/instructors/letter/{alpha}', [InstructorController::class, 'showByLetter'])->name('instructors.by_letter');

Route::middleware(['auth', 'preventBackHistory'])->group(function () {
    Route::prefix('user')->group(function () {
        Route::get('/table', [UserController::class, 'table'])->name('table');
    });

    Route::prefix('admin')->group(function () {
        Route::get('/dashboard', [AuthController::class, 'dashboard'])->name('dashboard');

        Route::prefix('dashboard')->group(function () {
            Route::get('/profile', [AdminController::class, 'profile'])->name('profile');
            Route::get('/users', [AdminController::class, 'users'])->name('users');
            Route::post('/users/create', [AdminController::class, 'create'])->name('user.create');
            Route::delete('/users/delete/{id}', [AdminController::class, 'destroy'])->name('user.delete');
            Route::put('/users/update/{id}', [AdminController::class, 'update'])->name('user.update');
            Route::get('/instructor', [InstructorController::class, 'index'])->name('instructor');
            Route::post('/mail', [EmailController::class, 'getEmail'])->name('getEmail');
            Route::get('/mail', [EmailController::class, 'sendMail'])->name('mail');
            Route::get('/report', [ReportController::class, 'index'])->name('report');

        });
        
            Route::get('/schedules', [InstructorController::class, 'schedules'])->name('schedules');
            Route::get('/manage-email', [MailController::class, 'index'])->name('manage-emails');



        });
});

Route::get('/search', [SearchController::class, 'index'])->name('search');
