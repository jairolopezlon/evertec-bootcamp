@extends('layouts.dashboard')


@section('title', 'Dashboard Products List')
@section('option-content')
    <table class="dashboard-products-table">
        <thead>
            <tr>
                <th>Id</th>
                <th>Image</th>
                <th>Name</th>
                <th>Description</th>
                <th>Quantity in Stock</th>
                <th>Price</th>
                <th>Stock</th>
                <th>Status</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($products as $product)
                <tr>
                    <td>{{ $product->id }}</td>
                    <td>
                        <img class="product-image" src="{{ $product->image_url }}" alt="{{ $product->name }}">
                    </td>
                    <td>{{ $product->name }}</td>
                    <td>{{ $product->description }}</td>
                    <td>{{ $product->stock }}</td>
                    <td>{{ $product->price }}</td>
                    <td>{{ $product->has_availability ? 'In Stock' : 'Out of Stock' }}</td>
                    <td>{{ $product->is_enabled ? 'Enabled' : 'Disabled' }}</td>
                    <td class="">
                        <div class="actions">

                            <form method="POST"
                                action="{{ route('dashboard.products.toggle_enable_disable', $product->id) }}">
                                @csrf
                                @method('PATCH')
                                <button type="submit">{{ $product->is_enabled ? 'Enable' : 'Disable' }}</button>
                            </form>
                            <a href="{{ route('dashboard.products.show', ['product' => $product->id]) }}">Show</a>
                            <a href="{{ route('dashboard.products.edit', ['product' => $product->id]) }}">Edit</a>
                            <form method="POST" action="{{ route('dashboard.products.destroy', $product->id) }}">
                                @csrf
                                @method('DELETE')
                                <button type="submit">Delete</button>
                            </form>
                        </div>
                    </td>
                </tr>
            @endforeach
        </tbody>
    </table>
@endsection
