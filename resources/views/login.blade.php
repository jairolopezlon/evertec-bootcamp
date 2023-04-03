<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Document</title>
    @vite(['resources/js/app.js'])
    <style>
        .form_field {
            display: flex;
            flex-direction: column;
            gap: .25rem;
        }

        .invalid-feedback-container {
            display: flex;
            flex-direction: column;
            gap: .125rem;
        }

        .invalid-feedback {
            color: #ff0000;
            font-size: .8rem;
        }
    </style>
</head>

<body>
    <div id="app">
        <div>
            @include('partials.menu')
        </div>
        <form method="POST" id="loginForm"
            style="display: flex; flex-direction:column; gap: .5rem; width:min(100%, 400px);">
            @csrf
            <div class="form_field">
                <label for="email">Email</label>
                <input type="email" name="email" id="email" required autofocus value="{{ old('email') }}">
                @error('email')
                    <div class="invalid-feedback-container">
                        @foreach ($errors->get('email') as $error)
                            <span class="invalid-feedback">{{ $error }}</span>
                        @endforeach
                    </div>
                @enderror
            </div>
            <div class="form_field">
                <label for="pasword">Password</label>
                <input type="password" required name="password" id="password">
                @error('password')
                    <div class="invalid-feedback-container">
                        @foreach ($errors->get('password') as $error)
                            <span class="invalid-feedback">{{ $error }}</span>
                        @endforeach
                    </div>
                @enderror
            </div>
            <button type="submit">Login</button>
        </form>
    </div>
</body>

</html>
