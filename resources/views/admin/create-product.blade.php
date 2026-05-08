@extends('layouts.app')

@section('content')

<div class="container mt-5">

<h2>Add Product</h2>

<form method="POST" action="/admin/products">
@csrf

<input name="name" placeholder="Name" class="form-control mb-2">
<input name="price" placeholder="Price" class="form-control mb-2">
<input name="image" placeholder="Image URL" class="form-control mb-2">

<button class="btn btn-success">Save</button>

</form>

</div>

@endsection