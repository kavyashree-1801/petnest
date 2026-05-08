@extends('layouts.app')

@section('content')

<div class="container mt-5">

<h2>Edit Product</h2>

<form method="POST" action="/admin/products/update/{{ $product->id }}">
@csrf

<input name="name" value="{{ $product->name }}" class="form-control mb-2">
<input name="price" value="{{ $product->price }}" class="form-control mb-2">
<input name="image" value="{{ $product->image }}" class="form-control mb-2">

<button class="btn btn-primary">Update</button>

</form>

</div>

@endsection