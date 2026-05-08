@extends('layouts.admin')

@section('title', 'Order Detail')

@section('content')

<div class="card p-4 shadow">

    <h4 class="mb-3">Order #{{ $order->id }}</h4>

    <div class="mb-3">
        <strong>Customer:</strong> {{ $order->name }} <br>
        <strong>Email:</strong> {{ $order->email }} <br>
        <strong>Phone:</strong> {{ $order->phone }} <br>
        <strong>Address:</strong> {{ $order->address }}
    </div>

    <div class="mb-3">
        <strong>Status:</strong>
        <span class="badge bg-primary">{{ $order->status }}</span>

        <br>

        <strong>Delivery:</strong>
        <span class="badge
            @if($order->delivery_status == 'processing') bg-warning text-dark
            @elseif($order->delivery_status == 'shipped') bg-info
            @elseif($order->delivery_status == 'delivered') bg-success
            @elseif($order->delivery_status == 'cancelled') bg-danger
            @else bg-secondary
            @endif
        ">
            {{ ucfirst($order->delivery_status) }}
        </span>
    </div>

    <table class="table mt-3">
        <thead class="table-light">
            <tr>
                <th>Product</th>
                <th width="100">Qty</th>
                <th width="120">Price</th>
                <th width="120">Subtotal</th>
            </tr>
        </thead>

        <tbody>
            @foreach($order->items as $item)
            <tr>
                <td>{{ $item->product_name }}</td>
                <td>{{ $item->quantity }}</td>
                <td>₹{{ number_format($item->price) }}</td>
                <td>₹{{ number_format($item->price * $item->quantity) }}</td>
            </tr>
            @endforeach
        </tbody>
    </table>

    <div class="text-end mt-3">
        <h5>Total: ₹{{ number_format($order->total) }}</h5>
    </div>

</div>

@endsection