@extends('layouts.dashboard')


@section('title', 'Dashboard Products List')
@section('option-content')
    <table class="dashboard-products-table">
        <thead>
            <tr>
                <th>Id</th>
                <th>Name</th>
                <th>Email</th>
                <th>Is Enabled</th>
                <th>Actions</th>
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
                    <td>{{ $product->is_available ? 'available' : 'unavailable' }}</td>
                    <td class="actions">
                        {{-- <form method="POST" action="{{ route('dashboard.products.toggle-status', $product->id) }}">
                            @csrf
                            <button type="submit">{{ $product->is_available ? 'available' : 'unavailable' }}</button>
                        </form> --}}
                        <form method="POST" action="{{ route('dashboard.products.edit', $product->id) }}">
                            @csrf
                            <button type="submit">Edit</button>
                        </form>
                        <form method="POST" action="{{ route('dashboard.products.destroy', $product->id) }}">
                            @csrf
                            <button type="submit">Delete</button>
                        </form>
                    </td>
                </tr>
            @endforeach
        </tbody>
    </table>
@endsection
