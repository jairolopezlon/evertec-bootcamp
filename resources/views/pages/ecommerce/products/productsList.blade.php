@extends('layouts.ecommerce')


@section('title', 'Ecommerce Products List')
@section('ecommerce-content')
    <h1>Products List Ecommercedddddddddd</h1>
    {{-- {{ dd(request()->input('filters', [])) }} --}}

    <br>
    <div class="p-4 bg-red-100">
        <a href="{{ route('ecommerce.shoppingCart.getAllItems') }}">

            <p>{{ count(session()->get('shoppingCart')->getItemsCart()) }} Cart</p>
            <pre style="font-size: .75rem">
                {{ print_r(session()->get('shoppingCart')) }}
            </pre>
        </a>
    </div>
    <br>
    <form style="border: 1px solid grey; padding: .5rem" action="{{ $products['criteriaLinks']['searchText'] }}"
        method="GET">
        <input type="hidden" name="filters[0][field]" value="searchText">
        <input type="search" name="filters[0][value]">
        <button type="submit">Search</button>
    </form>
    <a href="{{ route('ecommerce.products.productsList') }}">Show all</a>
    <br>
    <br>
    <div>
        <div>
            <a style="padding:.5rem; background-color:cornflowerblue; margin-left:1rem;"
                href="{{ $products['first_page_url'] }}">first page</a>
            <a style="padding:.5rem; background-color:cornflowerblue; margin-left:1rem;"
                href="{{ $products['prev_page_url'] }}">previus page</a>
            <a style="padding:.5rem; background-color:cornflowerblue; margin-left:1rem;" href="">current page</a>
            <a style="padding:.5rem; background-color:cornflowerblue; margin-left:1rem;"
                href="{{ $products['next_page_url'] }}">next page</a>
            <a style="padding:.5rem; background-color:cornflowerblue; margin-left:1rem;"
                href="{{ $products['last_page_url'] }}">last page</a>
        </div>
    </div>
    <br>
    <br>
    <div>
        <a style="padding:.5rem; background-color:cornflowerblue; margin-left:1rem;"
            href="{{ $products['criteriaLinks']['sortByPriceAsc'] }}">ordenar
            por precio, menor a mayor</a>
        <a style="padding:.5rem; background-color:cornflowerblue; margin-left:1rem;"
            href="{{ $products['criteriaLinks']['sortByPriceDesc'] }}">ordenar
            por precio, mayor a menor</a>
        <a style="padding:.5rem; background-color:cornflowerblue; margin-left:1rem;"
            href="{{ $products['criteriaLinks']['sortByNameAsc'] }}">ordenar
            por nombre, A a Z</a>
        <a style="padding:.5rem; background-color:cornflowerblue; margin-left:1rem;"
            href="{{ $products['criteriaLinks']['sortByNameDesc'] }}">ordenar
            por nombre, Z a A</a>
    </div>
    @php
        foreach ($products['data'] as $product) {
            $product->token = csrf_token();
        }
    @endphp
    <products-list :products="{{ json_encode($products['data']) }}"></products-list>
@endsection
