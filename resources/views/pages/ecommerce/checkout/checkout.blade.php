@extends('layouts.ecommerce')

@section('title', 'Checkout')
@section('ecommerce-content')
    <div class="p-4">
        <div class="flex justify-between">
            <h1 class="font-bold text-xl">Checkout Page</h1>
            <a class="flex gap-1 text-sm items-center" href="">
                <svg class="w-4" fill="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg"
                    aria-hidden="true">
                    <path clip-rule="evenodd" fill-rule="evenodd"
                        d="M11.03 3.97a.75.75 0 010 1.06l-6.22 6.22H21a.75.75 0 010 1.5H4.81l6.22 6.22a.75.75 0 11-1.06 1.06l-7.5-7.5a.75.75 0 010-1.06l7.5-7.5a.75.75 0 011.06 0z">
                    </path>
                </svg>
                Shopping Cart
            </a>
        </div>
        <div class="flex justify-center p-8">
            <div class="flex gap-4" style="width:min(100%, 900px)">
                <div class="flex flex-col gap-4 grow-[1]">
                    @if (count($messagesOfValidation) > 0)
                        <div class="flex gap-4 p-4  bg-red-200  rounded-md">
                            <svg class="stroke-red-400 w-[40px]" fill="none" stroke="currentColor" stroke-width="1.5"
                                viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg" aria-hidden="true">
                                <path stroke-linecap="round" stroke-linejoin="round"
                                    d="M12 9v3.75m9-.75a9 9 0 11-18 0 9 9 0 0118 0zm-9 3.75h.008v.008H12v-.008z"></path>
                            </svg>
                            <div class="flex flex-col p-2 gap-2">
                                @foreach ($messagesOfValidation as $msg)
                                    <p class="text-xs text-red-950">{{ $msg }}</p>
                                    {{-- {{ var_dump($msg) }} --}}
                                @endforeach
                            </div>
                        </div>
                    @endif
                    <list-items-checkout token="{{ csrf_token() }}"></list-items-checkout>
                </div>
                <aside-checkout token="{{ csrf_token() }}"></aside-checkout>
            </div>
        </div>
    </div>
@endsection
