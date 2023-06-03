@extends('layouts.ecommerce')


@section('title', 'Ecommerce Products List')
@section('ecommerce-content')
    <h1>Product Detail Ecommercedddddddddd</h1>
    <product-item :product="{{ json_encode($product) }}"></product-item>
@endsection
