@extends('layouts.ecommerce')

@section('title', 'Orders List')
@section('ecommerce-content')
    <div class="flex justify-center">
        <div class="flex flex-col py-4" style="width: min(900px, 100%)">
            <h1 class="font-bold text-xl">Orders</h1>
            <div class="flex flex-col gap-2">
                @foreach ($ordersByUSer as $order)
                    <div class="border-[1px] border-indigo-100 p-4 rounded-lg">
                        <div>
                            <div>
                                <span>payment provider</span>
                                <span> {{ $order['paymentProvider'] }} </span>
                            </div>
                            <div>
                                <span>Order status</span>
                                <span> {{ $order['paymentStatus'] }}</span>
                            </div>
                            <div>
                                <span>Total</span>
                                <span> {{ $order['total'] }} {{ $order['currency'] }}</span>
                            </div>
                        </div>
                        <div class="flex gap-1">
                            <button
                                class="px-4 py-2 rounded-[4px] bg-indigo-50 text-xs font-semibold hover:bg-indigo-200">Detail</button>
                            <button
                                class="px-4 py-2 rounded-[4px] bg-indigo-50 text-xs font-semibold hover:bg-indigo-200">Cancel</button>
                            <button
                                class="px-4 py-2 rounded-[4px] bg-indigo-50 text-xs font-semibold hover:bg-indigo-200">Detail</button>
                            <button
                                class="px-4 py-2 rounded-[4px] bg-indigo-50 text-xs font-semibold hover:bg-indigo-200">Go
                                to
                                Payment</button>
                        </div>
                        {{-- {{ print_r($order) }} --}}
                    </div>
                @endforeach
            </div>
        </div>
    </div>
@endsection
