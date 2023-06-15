@extends('layouts.ecommerce')

@section('title', 'Shopping Cart')
@section('ecommerce-content')
    <div class="flex justify-center mt-8">
        <div class="flex gap-4" style="width:min(100%, 900px)">
            <div class="grow-[1]">
                <h1 class="text-2xl font-bold text-indigo-950">shopping cart</h1>
                <list-items-shopping-cart token="{{ csrf_token() }}"></list-items-shopping-cart>
            </div>
            <aside-info-actions-cart></aside-info-actions-cart>
        </div>
    </div>
@endsection
