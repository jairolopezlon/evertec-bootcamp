@extends('layouts.app')

@section('title', 'Dashboard')

@section('content')
    @include('layouts.header')
    <main id="containerMain">
        @yield('ecommerce-content')
    </main>
    @include('layouts.footer')
@endsection
