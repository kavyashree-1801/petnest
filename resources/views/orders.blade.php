@extends('layouts.app')

@section('content')

<div style="
    min-height:100vh;
    background:
    linear-gradient(rgba(255,255,255,0.88), rgba(255,255,255,0.88)),
    url('https://media.istockphoto.com/id/1388281684/vector/seamless-dog-pattern-with-paw-prints-bones-hearts-and-balls-cat-foot-texture-pattern-with.jpg?s=612x612&w=0&k=20&c=St1dISSnU7zobbE4y1VWD7hhEnWcUGriSVZ5ocoSYWU=');
    background-size:cover;
    background-position:center;
    padding:50px 0;
">

<div class="container">

    <!-- HEADING -->
    <div class="text-center mb-5">

        <h1 class="fw-bold">
            📦 My Orders
        </h1>

        <p class="text-muted">
            Track and manage your PetNest purchases
        </p>

    </div>


    @forelse($orders as $order)

    @php
        $status = $order->delivery_status ?? 'pending';
    @endphp

    <div class="bg-white shadow rounded-4 p-4 mb-4">

        <!-- TOP -->
        <div class="d-flex justify-content-between align-items-center flex-wrap mb-4">

            <div>

                <h4 class="fw-bold mb-1">

                    Order #{{ $loop->iteration }}

                </h4>

                <p class="text-muted mb-0">

                    {{ $order->created_at->format('d M Y') }}

                </p>

            </div>

            <!-- STATUS -->
            <span class="badge
                @if($status == 'processing') bg-warning text-dark
                @elseif($status == 'shipped') bg-info
                @elseif($status == 'delivered') bg-success
                @elseif($status == 'cancelled') bg-danger
                @else bg-secondary
                @endif
            "
            style="
                padding:12px 20px;
                border-radius:30px;
                font-size:14px;
            ">

                {{ ucfirst($status) }}

            </span>

        </div>


        <!-- ADDRESS -->
        <div class="row mb-4">

            <div class="col-md-6">

                <p class="mb-2">

                    <strong>📍 Address:</strong>

                    {{ $order->address }}

                </p>

            </div>

            <div class="col-md-6">

                <p class="mb-2">

                    <strong>📞 Phone:</strong>

                    {{ $order->phone }}

                </p>

            </div>

        </div>


        <!-- TRACKING -->
        @if($status !== 'cancelled')

        <div class="mb-4">

            <p class="mb-2">

                <strong>🚚 Tracking ID:</strong>

                <span class="text-primary fw-bold">

                    {{ $order->tracking_id ?? 'Not Assigned Yet' }}

                </span>

            </p>

            <p class="mb-0">

                <strong>📅 Delivery Date:</strong>

                {{ $order->delivery_date
                    ? \Carbon\Carbon::parse($order->delivery_date)->format('d M Y')
                    : 'Not Scheduled' }}

            </p>

        </div>

        @else

        <div class="alert alert-danger">

            ❌ This order has been cancelled

        </div>

        @endif


        <!-- ITEMS -->
        <div class="table-responsive">

            <table class="table align-middle">

                <thead class="table-light">

                    <tr>

                        <th>Product</th>

                        <th>Qty</th>

                        <th>Price</th>

                        <th>Subtotal</th>

                    </tr>

                </thead>

                <tbody>

                    @forelse($order->items as $item)

                    <tr>

                        <td>

                            {{ $item->product_name ?: 'Product Not Available' }}

                        </td>

                        <td>

                            {{ $item->quantity }}

                        </td>

                        <td>

                            ₹{{ $item->price }}

                        </td>

                        <td>

                            ₹{{ $item->price * $item->quantity }}

                        </td>

                    </tr>

                    @empty

                    <tr>

                        <td colspan="4"
                            class="text-center text-muted">

                            No item details available

                        </td>

                    </tr>

                    @endforelse

                </tbody>

            </table>

        </div>


        <!-- TOTAL -->
        <div class="text-end mt-4">

            <h4 class="text-success fw-bold">

                Total: ₹{{ number_format($order->total, 2) }}

            </h4>

        </div>

    </div>

    @empty

    <!-- EMPTY -->
    <div class="bg-white shadow rounded-4 p-5 text-center mx-auto"
         style="max-width:650px;">

        <div style="font-size:80px;">
            📦
        </div>

        <h2 class="fw-bold mt-3">

            No Orders Yet

        </h2>

        <p class="text-muted mt-3">

            Start exploring amazing pet products today.

        </p>

        <a href="/products"
           class="btn btn-warning rounded-pill px-5 py-3 mt-3">

            Start Shopping

        </a>

    </div>

    @endforelse

</div>

</div>

@endsection