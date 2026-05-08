@extends('layouts.app')

@section('content')

<div class="container mt-4">
    <h2>Add Product</h2>

    <form method="POST" action="/add-product">
        @csrf

        <div class="mb-3">
            <label>Product Name</label>
            <input type="text" name="name" class="form-control">
        </div>

        <div class="mb-3">
            <label>Description</label>
            <textarea name="description" class="form-control"></textarea>
        </div>

        <div class="mb-3">
            <label>Price</label>
            <input type="number" name="price" class="form-control">
        </div>

        <div class="mb-3">
            <label>Image URL</label>
            <input type="text" name="image" class="form-control">
        </div>

        <div class="mb-3">
            <label>Category</label>
            <select name="category_id" class="form-control">
                <option value="">Select Category</option>
                @foreach($categories as $category)
                    <option value="{{ $category->id }}">{{ $category->name }}</option>
                @endforeach
            </select>
        </div>

        <button class="btn btn-success">Add Product</button>
    </form>
</div>

@endsection