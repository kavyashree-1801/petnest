@extends('layouts.admin')

@section('title', 'Delivery')

@section('content')

<div class="card shadow p-4">

    <h5 class="mb-4">🚚 Delivery Management</h5>

    <!-- FILTER -->
    <form method="GET" class="mb-3 d-flex gap-2">
        <select name="status" class="form-select w-auto">
            <option value="">All</option>
            <option value="pending">Pending</option>
            <option value="processing">Processing</option>
            <option value="shipped">Shipped</option>
            <option value="delivered">Delivered</option>
        </select>

        <button class="btn btn-primary">Filter</button>
    </form>

    <table class="table align-middle">

        <thead class="table-light">
            <tr>
                <th>Order</th>
                <th>Customer</th>
                <th>Address</th>
                <th>Status</th>
                <th>Tracking</th>
                <th>Date</th>
                <th>Update</th>
            </tr>
        </thead>

        <tbody>
            @foreach($orders as $order)
            <tr>

                <td>#{{ $order->id }}</td>

                <td>{{ $order->name ?? 'N/A' }}</td>
                <td>{{ $order->address ?? 'N/A' }}</td>

                <td>
                    <span class="badge
                        @if($order->delivery_status == 'pending') bg-secondary
                        @elseif($order->delivery_status == 'processing') bg-warning text-dark
                        @elseif($order->delivery_status == 'shipped') bg-info
                        @elseif($order->delivery_status == 'delivered') bg-success
                        @elseif($order->delivery_status == 'cancelled') bg-danger
                        @else bg-secondary
                        @endif
                        ">
                        {{ ucfirst($order->delivery_status ?? 'pending') }}
                    </span>
                </td>

                <td>{{ $order->tracking_id ?? '-' }}</td>

                <td>{{ $order->delivery_date ?? '-' }}</td>

                <td>

                    <form action="/admin/delivery/{{ $order->id }}" method="POST">
                        @csrf

                        <input type="date" name="delivery_date" 
                               class="form-control form-control-sm mb-1">

                        <button class="btn btn-sm btn-primary w-100">
                            Update
                        </button>
                    </form>

                </td>

            </tr>
            @endforeach
        </tbody>

    </table>

    {{ $orders->links() }}

</div>

@endsection