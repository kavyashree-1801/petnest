@extends('layouts.admin')

@section('title', 'Order Detail')

@section('content')

<div class="card p-4 shadow">

    <h5>Order #{{ $order->id }}</h5>

    <p><strong>Customer:</strong> {{ $order->customer_name ?? $order->name }}</p>
    <p><strong>Address:</strong> {{ $order->address }}</p>

    <table class="table mt-3">
        <thead>
            <tr>
                <th>Product</th>
                <th>Qty</th>
                <th>Price</th>
                <th>Subtotal</th>
            </tr>
        </thead>

        <tbody>
            @foreach($order->items as $item)
            <tr>
                <td>{{ $item->product_name }}</td>
                <td>{{ $item->quantity }}</td>
                <td>₹{{ number_format($item->price, 2) }}</td>
                <td>₹{{ number_format($item->price * $item->quantity, 2) }}</td>
            </tr>
            @endforeach
        </tbody>
    </table>

    <h5 class="text-end">Total: ₹{{ number_format($order->total, 2) }}</h5>

</div>

@endsection