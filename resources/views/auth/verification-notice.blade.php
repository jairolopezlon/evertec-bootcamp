<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Verification Notice</title>
    @vite(['resources/js/app.js'])
</head>

<body>
    <div id="app">
        <div>
            @include('partials.menu')
        </div>
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
                                {{ __('If you did not receive the email') }}, <a
                                    href="{{ route('verification.resend') }}">{{ __('click here to request another') }}</a>.
                            @endif
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</body>

</html>
