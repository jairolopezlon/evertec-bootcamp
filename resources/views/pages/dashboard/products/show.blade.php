@extends('layouts.dashboard')


@section('title', 'Dashboard Products {{ $product->name }}')
@section('option-content')
    <div class="show-product">
        <div class="show-product__header">
            <a href="{{ route('dashboard.products.index') }}">Volver</a>
        </div>
        <div class="show-product__body">
            @if (isset($productNotFound))
                <div class="">
                    <p>El producto no existe</p>
                    <a href="{{ route('dashboard.products.index') }}">
                        <-regresar a listado de producto</a>
                </div>
            @else
                <div class="">
                    <h1>{{ $product->name }}</h1>
                    <p>{{ $product->description }}</p>
                    <p>Precio: {{ $product->price }}</p>
                    <p>Disponible: {{ $product->is_available ? 'Sí' : 'No' }}</p>
                    <img src="{{ $product->image_url }}" alt="{{ $product->name }}" width="200">
                </div>
            @endif
        </div>
    </div>
@endsection
