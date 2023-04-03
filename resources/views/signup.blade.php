<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Sign-up</title>
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
        <form method="POST" id="signupForm"
            style="display: flex; flex-direction:column; gap: .5rem; width:min(100%, 400px);">
            @csrf
            <div class="form_field">
                <label for="name">Name</label>
                <input type="text" name="name" id="name" required autofocus value="{{ old('name') }}">
                @error('name')
                    <div class="invalid-feedback-container">
                        @foreach ($errors->get('name') as $error)
                            <span class="invalid-feedback">{{ $error }}</span>
                        @endforeach
                    </div>
                @enderror
            </div>
            <div class="form_field">
                <label for="email">Email</label>
                <input type="text" name="email" id="email" required value="{{ old('email') }}">
                @error('email')
                    <div class="invalid-feedback-container">
                        @foreach ($errors->get('email') as $error)
                            <span class="invalid-feedback">{{ $error }}</span>
                        @endforeach
                    </div>
                @enderror
            </div>
            <div class="form_field">
                <label for="password">Password</label>
                <input type="password" name="password" id="password" required value="password">
                @error('password')
                    <div class="invalid-feedback-container">
                        @foreach ($errors->get('password') as $error)
                            <span class="invalid-feedback">{{ $error }}</span>
                        @endforeach
                    </div>
                @enderror
            </div>
            <div class="form_field">
                <label for="password_confirmation">Password confirmation</label>
                <input type="password" name="password_confirmation" id="password_confirmation" required
                    value="password">
            </div>
            <button type="submit">Sign-up</button>
        </form>
        <a href="/login">Already have a account? Sign-in</a>
    </div>
</body>

</html>
