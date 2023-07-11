@extends('layouts.ecommerce')

@section('title', 'Payment response')
@section('ecommerce-content')
    <div class="flex justify-center items-center flex-col grow-[1] gap-6">
        <img class="w-[120px]" src="/img/app/shopping-bag-success.png" alt="shopping-bag-image">
        <div class="flex flex-col items-center text-indigo-900">
            <span class="text-center">Order number {{ $paymentResponseData['orderId'] }}</span>
            <span class="text-center">{{ $paymentResponseData['message'] }}</span>
            <span class=" text-center text-xl font-bold">Thanks for your order!</span>
        </div>
        <div class="flex gap-4">
            <a class="py-2 px-8 outline outline-1 outline-indigo-700 text-indigo-700 rounded-md"
                href="{{ route('ecommerce.orders.index') }}">Go to Order list</a>
            <a class="py-2 px-8 bg-indigo-700 text-indigo-100 rounded-md"
                href="{{ route('ecommerce.products.productsList') }}">Continue to
                products list</a>
        </div>
    </div>
@endsection
