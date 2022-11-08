@extends('layouts.app')

@section('title')
Edit @endsection

@section('content')
    <h1>Edit a product</h1>
    <form method="POST" action={{ route('products.update', ['product' => $product->id])}}>
        @csrf
        @method('PUT')

        <div class="form-row">
            <label>Title</label>
            <input class="form-control" value="{{ old('title') ?? $product->title }}" type="text" name="title" required>
        </div>
        <div class="form-row">
            <label>Description</label>
            <input class="form-control" value="{{ old('description') ?? $product->description }}" type="text" name="description" required>
        </div>
        <div class="form-row">
            <label>Price</label>
            <input class="form-control" value="{{ old('price') ?? $product->price }}" type="number" min="1.00" step="0.01" name="price" required>
        </div>
        <div class="form-row">
            <label>Stock</label>
            <input class="form-control" value="{{ old('stock') ?? $product->stock }}" type="number" min="0" name="stock" required>
        </div>
        <div class="form-row mt-3">
            <label>Status</label>
            <select class="custom-select" name="status" required="" >
                <option value="available"   {{ old() == 'available' ? 'selected' : ($product->status == 'available'   ? 'selected'  : '')}}>Available</option>
                <option value="unavailable" {{ old() == 'unavailable' ? 'selected' : ($product->status == 'unavailable' ? 'selected'  : '')}}>Unavailable</option>
            </select>
        </div>
        <div class="form-row mt-3">
            <button class="btn btn-primary btm-lg" type="submit">Update Product</button>
        </div>
    </form>
@endsection