@extends('layouts.app')

@section('title', 'login')

@section('content')
    @include('layouts.header')
    <form method="POST" id="loginForm" style="display: flex; flex-direction:column; gap: .5rem; width:min(100%, 400px);">
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
@endsection
