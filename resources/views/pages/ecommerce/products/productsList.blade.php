@extends('layouts.ecommerce')


@section('title', 'Ecommerce Products List')
@section('ecommerce-content')
    <h1>Products List Ecommercedddddddddd</h1>
    <products-list :products="{{ json_encode($products) }}"></products-list>
@endsection
