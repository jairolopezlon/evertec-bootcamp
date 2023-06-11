@extends('layouts.dashboard')


@section('title', 'Dashboard Products List')
@section('option-content')
    <form action="{{ route('dashboard.products.store') }}" method="POST" enctype="multipart/form-data">
        @csrf
        <div class="form_field">
            <label for="name">Nombre:</label>
            <input type="text" name="name" id="name" value="{{ old('name') }}">
        </div>
        <div class="form_field">
            <label for="description">Descripción:</label>
            <textarea name="description" id="description">{{ old('description') }}</textarea>
        </div>
        <div class="form_field">
            <label for="price">Precio:</label>
            <input type="number" name="price" id="price" value="{{ old('price') }}">
        </div>
        <div class="form_field">
            <label for="price">Stock:</label>
            <input type="number" name="stock" id="stock" value="{{ old('stock') }}">
        </div>
        <div class="form_field">
            <label for="is_enable">Habilitado:</label>
            <input type="checkbox" name="is_enabled" id="is_enable" {{ old('is_enable') ? 'checked' : '' }}>
        </div>
        <div class="form_field">
            <label for="image_url">Imagen:</label>
            <input type="file" name="image" id="image_url" accept="image/*">
        </div>
        <button type="submit">Guardar</button>
    </form>
@endsection
