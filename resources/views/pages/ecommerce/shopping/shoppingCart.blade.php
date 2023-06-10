@extends('layouts.ecommerce')

@section('title', 'Shopping Cart')
@section('ecommerce-content')
    <div class="px-4">
        <h1 class="text-2xl font-bold text-indigo-950">shopping cart</h1>
        <div class="flex flex-col gap-4" style="width: min(600px, 100%);">
            <list-items-shopping-cart token="{{ csrf_token() }}"></list-items-shopping-cart>
        </div>
    </div>
@endsection
