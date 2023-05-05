<?php

use App\Http\Controllers\AuthenticationController;
use Illuminate\Validation\ValidationException;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Auth\Events\Registered;
use App\Models\Customer;
use App\Models\User;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Illuminate\Support\Facades\DB;

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
Route::view('/', 'pages.home')->name('home');

Route::get('/signup', [AuthenticationController::class, 'signupView'])->middleware('guest')->name('login');
Route::get('/login', [AuthenticationController::class, 'loginView'])->middleware('guest')->name('login');
Route::get('/email/verify/notice', [AuthenticationController::class, 'verifyEmailMessageView'])
    ->middleware(['auth', 'redirectIfVerifying'])->name('verification.notice');
Route::get('/email/verify/{id}/{hash}', [AuthenticationController::class, 'emailVerification'])
    ->middleware(['auth', 'redirectIfVerifying', 'signed'])->name('verification.verify');
Route::get('/email/verify/resend', [AuthenticationController::class, 'resentEmailToVerify'])
    ->middleware(['auth', 'redirectIfVerifying'])->name('verification.resend');

Route::get('/dashboard', function () {
    $user_id = Auth::user()->id;
    $customer_exists = DB::table('admins')->where('user_id', $user_id)->exists();
    if (!$customer_exists) {
        abort(403, 'No tienes acceso a esta página');
    }

    $customers = DB::table('users')
        ->leftJoin('customers', 'users.id', '=', 'customers.user_id')
        ->select('users.*', 'customers.is_enabled')
        ->get();

    return view('pages.dashboard', [
        'customers' => $customers
    ]);
})->middleware(['auth', 'validateAdminAccess'])->name('dashboard');

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

        $customer = Customer::create([
            'is_enable' => false,
            'user_id' => $user->id,
        ]);

        event(new Registered($user));
        $user->sendEmailVerificationNotification();

        Auth()->login($user);
        $request->session()->put('email', $user->email);

        return redirect()->route('verification.notice');
    } catch (ValidationException $exception) {
        return redirect('signup')->withErrors($exception->errors())->withInput();
    }
});

Route::post('/users/{id}/toggle-enable', function (Request $request, $id) {
    try {
        /** @var Customer $customer */
        $customer = Customer::findOrFail($id);
        $customer->is_enabled = !$customer->is_enabled;
        $customer->save();
    } catch (ModelNotFoundException $exception) {
        abort(404);
    }
    return redirect()->back();
})->name('users.toggle-enable');

Route::post('/logout', [AuthenticationController::class, 'logout']);
