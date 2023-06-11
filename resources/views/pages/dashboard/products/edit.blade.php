@extends('layouts.dashboard')


@section('title', 'Dashboard Products List')
@section('option-content')
    <form method="POST" action="{{ route('dashboard.products.update', $product->id) }}" enctype="multipart/form-data">
        @csrf
        @method('PUT')
        <div class="form_field">
            <label for="name">Name</label>
            <input type="text" id="name" name="name" value="{{ $product->name }}" required>
        </div>

        <div class="form_field">
            <label for="description">Description</label>
            <textarea id="description" name="description">{{ $product->description }}</textarea>
        </div>

        <div class="form_field">
            <label for="price">Price</label>
            <input type="number" id="price" name="price" step="0.01" value="{{ $product->price }}" required>
        </div>

        <div class="form_field">
            <label for="price">Stock</label>
            <input type="number" id="stock" name="stock" step="1" value="{{ $product->stock }}" required>
        </div>

        <div class="form_field form_field--x">
            <label for="is_enabled">Enable</label>
            <input type="checkbox" id="is_enabled" name="is_enabled" value="1"
                {{ $product->is_enabled ? 'checked' : '' }}>
        </div>

        <div class="form_field">
            <label for="image">Image</label>
            <input type="file" id="image" name="image" accept="image/*">
            @if ($product->image_url)
                <img src="{{ $product->image_url }}" alt="Product Image Preview"
                    style="width: min(300px, 100%); height: auto;">
            @endif
            {{-- <script>
                document.getElementById('image').addEventListener('change', function() {
                    var file = this.files[0];
                    var reader = new FileReader();
                    reader.onload = function(e) {
                        document.getElementById('image_preview').src = e.target.result;
                    };
                    reader.readAsDataURL(file);
                });
            </script> --}}
        </div>
        <button type="submit">Save</button>

    </form>

@endsection
