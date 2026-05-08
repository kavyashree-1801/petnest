@extends('layouts.app')

@section('content')

<style>
body {
    background: linear-gradient(rgba(0,0,0,0.6), rgba(0,0,0,0.7)),
    url('https://www.shutterstock.com/image-photo/flat-lay-composition-food-snacks-600nw-2722237551.jpg');
    background-size: cover;
    background-position: center;
    background-attachment: fixed;
}

.table {
    background: white;
    border-radius: 10px;
    overflow: hidden;
}

h2 {
    color: white;
    font-weight: bold;
}
</style>

<div class="container mt-5">

<h2 class="mb-4 text-center">My Orders 📦</h2>

@if($orders->count() > 0)

<table class="table table-bordered text-center">

<thead class="table-dark">
    <tr>
        <th>#</th>
        <th>Products</th>
        <th>Total</th>
        <th>Status</th>
        <th>Expiry / Action</th>
        <th>Payment ID</th>
        <th>Date</th>
    </tr>
</thead>

<tbody>

@foreach($orders as $order)

@php
$expiresAt = $order->created_at->copy()->addMinutes(15);
$isExpired = now()->greaterThan($expiresAt);
@endphp

<tr>

<td>{{ $loop->iteration }}</td>

<!-- PRODUCTS -->
<td style="text-align:left;">
    @if($order->items->count() > 0)
        @foreach($order->items as $item)
            <div>
                {{ $item->product_name }} 
                (x{{ $item->quantity }}) 
                - ₹{{ $item->price }}
            </div>
        @endforeach
    @else
        <span class="text-muted">No products</span>
    @endif
</td>

<td>₹{{ $order->total }}</td>

<!-- STATUS -->
<td>
    @if($order->status === 'paid')
        <span class="badge bg-success">Paid</span>

    @elseif($order->status === 'cancelled' || $isExpired)
        <span class="badge bg-danger">Cancelled</span>

    @else
        <span class="badge bg-warning">Pending</span>
    @endif
</td>

<!-- EXPIRY -->
<td>
    @if($order->status === 'paid')
        <span class="text-success">Completed</span>

    @elseif($order->status === 'cancelled' || $isExpired)
        <span class="text-danger">Expired</span>

    @else
        @php
            $minutesLeft = ceil(($expiresAt->timestamp - now()->timestamp) / 60);
        @endphp

        <div class="text-muted small">
            Expires in {{ $minutesLeft }} min
        </div>

        <div class="mt-2">
            <a href="/retry-payment/{{ $order->id }}" class="btn btn-sm btn-primary">
                Retry Payment
            </a>
        </div>
    @endif
</td>

<td>{{ $order->payment_id ?? '-' }}</td>

<td>{{ $order->created_at->format('d M Y h:i A') }}</td>


</tr>

@endforeach

</tbody>

</table>

@else

<p class="text-center text-white">No orders found 🐾</p>

@endif

<div class="text-center mt-4">
    <a href="/" class="btn btn-light">Back to Home</a>
</div>

</div>

@endsection
