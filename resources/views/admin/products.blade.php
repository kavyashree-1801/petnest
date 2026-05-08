@extends('layouts.admin')

@section('title', 'Products')

@section('content')

<div class="card shadow p-4">
    <div class="d-flex justify-content-between mb-3">
        <h5>📦 Products</h5>
        <a href="/admin/products/create" class="btn btn-primary">+ Add Product</a>
    </div>

    <table class="table">
        <thead>
            <tr>
                <th>Name</th>
                <th>Price</th>
                <th>Image</th>
                <th width="150">Action</th>
            </tr>
        </thead>

        <tbody>
            @foreach($products as $product)
            <tr>
                <td>{{ $product->name }}</td>
                <td>₹{{ number_format($product->price, 2) }}</td>
                <td><img src="{{ $product->image }}" width="50"></td>
                <td>
                    <a href="/admin/products/edit/{{ $product->id }}" class="btn btn-sm btn-warning">Edit</a>
                    <a href="/admin/products/delete/{{ $product->id }}" 
                       class="btn btn-sm btn-danger"
                       onclick="return confirm('Delete this product?')">
                       Delete
                    </a>
                </td>
            </tr>
            @endforeach
        </tbody>
    </table>

    {{ $products->links() }}
</div>

@endsection