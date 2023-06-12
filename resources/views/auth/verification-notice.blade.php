@extends('layouts.app')
@section('title', 'Verification Notice')
@section('content')
    @include('layouts.header')
    <div id="containerMain">
        <div class="container">
            <div class="row justify-content-center">
                <div class="col-md-8">
                    <div class="card">
                        <div class="card-header">{{ __('Verify Your Email Address') }}</div>
                        <div class="card-body">
                            @if (session('verification_error'))
                                <div class="alert alert-success" role="alert">
                                    {{ __('Something went wrong, please request another email for a verification link.') }}
                                </div>
                            @else
                                @if (session('resent'))
                                    <div class="alert alert-success" role="alert">
                                        {{ __('A fresh verification link has been sent to your email address.') }}
                                    </div>
                                @endif

                                {{ __('Before proceeding, please check your email for a verification link.') }}
                                {{ __('If you did not receive the email') }}, <a class="text-sky-500"
                                    href="{{ route('verification.resend') }}">{{ __('click here to request another') }}</a>.
                            @endif
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    @include('layouts.footer')
@endsection
