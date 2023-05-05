<?php

use App\Http\Controllers\AuthenticationController;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;
use App\Models\Customer;
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
