<?php

use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Auth;

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

Route::view('/', 'welcome');
Route::view('/login', 'login');

Route::post('/login', function () {
    $credenciales = request()->only('password', 'email');
    if (Auth::attempt($credenciales)) {
        request()->session()->regenerate();
        return redirect('home');
    }
    return redirect('login');
});
