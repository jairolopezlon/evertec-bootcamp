<?php

namespace App\Http\Controllers;

use App\Http\Requests\EmailVerificationRequest;
use Illuminate\Contracts\View\View;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

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

    public function logout(Request $request): RedirectResponse
    {
        Auth::logout();
        $request->session()->invalidate();
        $request->session()->regenerateToken();
        return redirect()->route('home');
    }
}
