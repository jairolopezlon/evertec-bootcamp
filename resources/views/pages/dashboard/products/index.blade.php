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
                <th>Price</th>
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
                    <td>{{ $product->price }}</td>
                    <td>{{ $product->is_enable ? 'enable' : 'disable' }}</td>
                    <td class="">
                        <div class="actions">

                            <form method="POST"
                                action="{{ route('dashboard.products.toggle_enable_disable', $product->id) }}">
                                @csrf
                                @method('PATCH')
                                <button type="submit">{{ $product->is_enable ? 'Enable' : 'Disable' }}</button>
                            </form>
                            <a href="{{ route('dashboard.products.show', ['product' => $product->id]) }}">Show</a>
                            {{-- <form method="POST" action="{{ route('dashboard.products.edit', $product->id) }}">
                            @csrf
                            <button type="submit">Edit</button>
                        </form> --}}
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
