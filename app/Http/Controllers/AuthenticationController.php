<?php

namespace App\Http\Controllers;

use App\Http\Requests\EmailVerificationRequest;
use App\Models\Customer;
use App\Models\User;
use Illuminate\Auth\Events\Registered;
use Illuminate\Contracts\View\View;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\ValidationException;

class AuthenticationController extends Controller
{
    public function signupView(Request $request): View
    {
        return view('auth.signup');
    }
    public function loginView(Request $request): View
    {
        return view('auth.login');
    }
    public function verifyEmailMessageView(Request $request): View
    {
        return view('auth.verification-notice');
    }
    public function emailVerification(EmailVerificationRequest $request): RedirectResponse
    {
        $request->fulfill();
        return redirect()->route('home')->with('verification_status', true);
    }
    public function resentEmailToVerify(Request $request): RedirectResponse
    {
        Auth::user()->sendEmailVerificationNotification();
        return back()->with('resent', true);
    }
    /**
     * @throws \Illuminate\Validation\ValidationException
     */
    public function login(Request $request): RedirectResponse
    {
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
    }
    /**
     * @throws \Illuminate\Validation\ValidationException
     */
    public function signup(Request $request): RedirectResponse
    {
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
    }
    public function logout(Request $request): RedirectResponse
    {
        Auth::logout();
        $request->session()->invalidate();
        $request->session()->regenerateToken();
        return redirect()->route('home');
    }
}
