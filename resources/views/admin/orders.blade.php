@extends('layouts.admin')

@section('title', 'Orders')

@section('content')

<div class="card shadow p-4">

    <h5 class="mb-4">🛒 Orders</h5>

    @foreach($orders as $order)

    <div class="border rounded-4 mb-4 p-3">

        <!-- HEADER -->
        <div class="d-flex justify-content-between align-items-center mb-3">
            <div>
                <strong>Order #{{ $order->id }}</strong><br>
                <small class="text-muted">{{ $order->created_at->format('d M Y') }}</small>
            </div>

            <div>
                <span class="badge bg-dark">{{ ucfirst($order->status) }}</span>

                <span class="badge
                    @if($order->delivery_status == 'processing') bg-warning text-dark
                    @elseif($order->delivery_status == 'shipped') bg-info
                    @elseif($order->delivery_status == 'delivered') bg-success
                    @elseif($order->delivery_status == 'cancelled') bg-danger
                    @else bg-secondary
                    @endif
                ">
                    {{ ucfirst($order->delivery_status ?? 'pending') }}
                </span>
            </div>
        </div>

        <!-- CUSTOMER -->
        <div class="mb-3">
            <strong>{{ $order->name }}</strong><br>
            <small>{{ $order->phone }}</small><br>
            <small>{{ $order->address }}</small>
        </div>

        <!-- TRACKING -->
        <div class="mb-3">
            <strong>Tracking:</strong>
            <span class="text-primary">
                {{ $order->tracking_id ?? 'Not assigned' }}
            </span><br>

            <strong>Delivery:</strong>
            {{ $order->delivery_date ?? 'Not set' }}
        </div>

        <!-- ITEMS -->
        <table class="table">
            <thead>
                <tr>
                    <th>Product</th>
                    <th>Qty</th>
                    <th>Price</th>
                    <th>Total</th>
                </tr>
            </thead>

            <tbody>
                @forelse($order->items as $item)
                <tr>
                    <td>
                        {{ $item->product_name ? $item->product_name : '⚠️ Product not available' }}
                    </td>
                    <td>{{ $item->quantity }}</td>
                    <td>₹{{ $item->price }}</td>
                    <td>₹{{ $item->price * $item->quantity }}</td>
                </tr>
                @empty
                <tr>
                    <td colspan="4" class="text-center text-danger">
                         {{ $item->product_name }}
                    </td>
                </tr>
                @endforelse
            </tbody>
        </table>

        <!-- TOTAL -->
        <div class="text-end">
            <strong class="text-success">
                ₹{{ number_format($order->total, 2) }}
            </strong>
        </div>

        <!-- UPDATE -->
        <form action="/admin/orders/{{ $order->id }}" method="POST" class="mt-3">
            @csrf
            @method('PUT')

            <div class="row g-2">

                <div class="col-md-3">
                    <select name="status" class="form-select">
                        <option value="pending" {{ $order->status=='pending'?'selected':'' }}>Pending</option>
                        <option value="processing" {{ $order->status=='processing'?'selected':'' }}>Processing</option>
                        <option value="completed" {{ $order->status=='completed'?'selected':'' }}>Completed</option>
                        <option value="cancelled" {{ $order->status=='cancelled'?'selected':'' }}>Cancelled</option>
                    </select>
                </div>

                <div class="col-md-3">
                    <select name="delivery_status" class="form-select">
                        <option value="processing" {{ $order->delivery_status=='processing'?'selected':'' }}>Processing</option>
                        <option value="shipped" {{ $order->delivery_status=='shipped'?'selected':'' }}>Shipped</option>
                        <option value="delivered" {{ $order->delivery_status=='delivered'?'selected':'' }}>Delivered</option>
                        <option value="cancelled" {{ $order->delivery_status=='cancelled'?'selected':'' }}>Cancelled</option>
                    </select>
                </div>

                <div class="col-md-3">
                    <input type="date" name="delivery_date"
                        value="{{ $order->delivery_date }}"
                        class="form-control">
                </div>

                <div class="col-md-3">
                    <input type="text" name="tracking_id"
                        value="{{ $order->tracking_id }}"
                        placeholder="Tracking ID"
                        class="form-control">
                </div>

            </div>

            <button class="btn btn-primary mt-3">Update</button>
        </form>

    </div>

    @endforeach

    {{ $orders->links() }}

</div>

@endsection