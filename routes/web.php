<?php

use Illuminate\Validation\ValidationException;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use App\Models\User;

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

Route::view('/', 'home');
Route::view('/login', 'login')->name('login')->middleware('guest');
Route::view('/signup', 'signup')->name('signup')->middleware('guest');

Route::post('/login', function () {
    $credenciales = request()->only('password', 'email');
    if (Auth::attempt($credenciales)) {
        request()->session()->regenerate();
        return redirect('home');
    }
    return redirect('login');
});

Route::post('/signup', function (Request $request) {
    try {
        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|string|email|unique:users|max:255',
            'password' => 'required|string|min:8|confirmed',
        ]);

        $user = User::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => Hash::make($request->password),
        ]);

        Auth()->login($user);
        $request->session()->put('email', $user->email);
        return redirect('home');
    } catch (ValidationException  $exception) {
        return redirect('signup')->withErrors($exception->errors());
    }
});
