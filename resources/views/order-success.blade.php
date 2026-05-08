@extends('layouts.app')

@section('content')

<div class="container mt-5 text-center">
    
<h2 class="text-success">✅ Payment Successful!</h2>
<p class="mt-2">Thank you for your order 🐾</p>

</div>

<div class="container mt-4">
<div class="card shadow p-4">

    <h4 class="mb-3">Order Summary</h4>

    <p><strong>Name:</strong> {{ $order->name }}</p>
    <p><strong>Email:</strong> {{ $order->email }}</p>
    <p><strong>Phone:</strong> {{ $order->phone }}</p>
    <p><strong>Address:</strong> {{ $order->address }}</p>

    <hr>

    <h5>Total Paid: ₹{{ $order->total }}</h5>

    <p class="text-success mt-2">
        Payment ID: {{ $order->payment_id }}
    </p>

</div>

<div class="text-center mt-4">
    <a href="/" class="btn btn-primary">Back to Home</a>
</div>
</div>

@endsection
