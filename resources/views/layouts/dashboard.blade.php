@extends('layouts.app')

@section('title', 'Dashboard')

@section('content')
    @include('layouts.header')
    <main id="containerMain">
        <div class="dashboard dashboard-container">
            <ul class="dashboard__aside-nav-options">
                <li><a class="dashboard__aside-nav-option" href="{{ route('dashboard.customers.index') }}">Clientes Listar
                    </a>
                </li>
                <li><a class="dashboard__aside-nav-option" href="{{ route('dashboard.products.index') }}">Productos Listar</a>
                </li>
                <li><a class="dashboard__aside-nav-option" href="{{ route('dashboard.products.create') }}">Productos Crear</a>
                </li>
            </ul>
            <section class="dashboard__option-content">
                @yield('option-content')
            </section>
        </div>
    </main>
    @include('layouts.footer')
@endsection
