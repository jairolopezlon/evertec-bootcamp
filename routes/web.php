<?php

use Illuminate\Validation\ValidationException;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Auth\Events\Registered;
use App\Http\Requests\EmailVerificationRequest;
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


// REDIRECTS
Route::redirect('/home', '/');


// PAGES
Route::view('/', 'home')->name('home');

Route::view('/login', 'login')->name('login')->middleware('guest');

Route::view('/signup', 'signup')->name('signup')->middleware('guest');

Route::get('/email/verify/notice', function () {
    return view('auth.verification-notice');
})->middleware(['auth', 'redirectIfVerifying'])->name('verification.notice');

Route::get('/email/verify/{id}/{hash}', function (EmailVerificationRequest $request) {
    $request->fulfill();
    return redirect()->route('home')->with('verification_status', true);
})->middleware(['auth', 'redirectIfVerifying',  'signed'])->name('verification.verify');

Route::get('/email/verify/resend', function () {
    Auth::user()->sendEmailVerificationNotification();
    return back()->with('resent', true);
})->middleware(['auth', 'redirectIfVerifying'])->name('verification.resend');


// POST REQUEST
Route::post('/login', function (Request $request) {
    $credenciales = $request->validate([
        'email' => ['required', 'email', 'string'],
        'password' => ['required', 'string'],
    ]);
    if (Auth::attempt($credenciales)) {
        request()->session()->regenerate();
        return redirect()->intended('home');
    }
    throw ValidationException::withMessages([
        'email' => 'incorrect credentials'
    ]);
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
            'email_verified_at' => null, // set email_verified_at to null by default
        ]);

        event(new Registered($user));
        $user->sendEmailVerificationNotification();

        Auth()->login($user);
        $request->session()->put('email', $user->email);

        return redirect()->route('verification.notice');
    } catch (ValidationException  $exception) {
        return redirect('signup')->withErrors($exception->errors())->withInput();
    }
});
