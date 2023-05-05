<?php

use App\Http\Controllers\AuthenticationController;
use App\Http\Controllers\Dashboard\UsersManagerController;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/


Route::redirect('/home', '/');

Route::view('/', 'pages.home')->name('home');

Route::get('/signup', [AuthenticationController::class, 'signupView'])->middleware('guest')->name('login');

Route::get('/login', [AuthenticationController::class, 'loginView'])->middleware('guest')->name('login');

Route::get('/email/verify/notice', [AuthenticationController::class, 'verifyEmailMessageView'])
    ->middleware(['auth', 'redirectIfVerifying'])->name('verification.notice');

Route::get('/email/verify/{id}/{hash}', [AuthenticationController::class, 'emailVerification'])
    ->middleware(['auth', 'redirectIfVerifying', 'signed'])->name('verification.verify');

Route::get('/email/verify/resend', [AuthenticationController::class, 'resentEmailToVerify'])
    ->middleware(['auth', 'redirectIfVerifying'])->name('verification.resend');

Route::post('/login', [AuthenticationController::class, 'login']);

Route::post('/signup', [AuthenticationController::class, 'signup']);

Route::post('/logout', [AuthenticationController::class, 'logout']);

Route::get('/dashboard', [UsersManagerController::class, 'dashboardView'])
    ->middleware(['auth', 'validateAdminAccess'])->name('dashboard');

Route::post('/users/{id}/toggle-enable', [UsersManagerController::class, 'toggleUserStatus'])
    ->name('users.toggle-enable');
