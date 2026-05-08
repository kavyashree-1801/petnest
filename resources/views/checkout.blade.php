@extends('layouts.app')

@section('content')

<div class="container mt-5">

<h2>Checkout</h2>

<table class="table">
    <tr>
        <th>Product</th>
        <th>Price</th>
        <th>Qty</th>
        <th>Total</th>
    </tr>

    @foreach($cart as $item)
    <tr>
        <td>{{ $item['name'] }}</td>
        <td>₹{{ $item['price'] }}</td>
        <td>{{ $item['quantity'] }}</td>
        <td>₹{{ $item['price'] * $item['quantity'] }}</td>
    </tr>
    @endforeach
</table>

<h4>Total: ₹{{ $total }}</h4>

<form method="POST" action="/checkout">
    @csrf

    <input type="text" name="name" class="form-control mb-2" placeholder="Name" required>
    <input type="email" name="email" class="form-control mb-2" placeholder="Email" required>
    <input type="text" name="phone" class="form-control mb-2" placeholder="Phone" required>
    <textarea name="address" class="form-control mb-2" placeholder="Address" required></textarea>

    <button class="btn btn-success">Proceed to Payment</button>
</form>

</div>

@endsection