@extends('layouts.admin')

@section('title', 'Dashboard')

@section('content')

<h4 class="mb-4">
    Dashboard
</h4>

<!-- 🔥 STATS -->
<div class="row mb-4">

    <div class="col-md-3">
        <div class="card p-3 shadow text-center bg-primary text-white">
            <h6>Users</h6>
            <h3>{{ $users }}</h3>
        </div>
    </div>

    <div class="col-md-3">
        <div class="card p-3 shadow text-center bg-success text-white">
            <h6>Products</h6>
            <h3>{{ $products }}</h3>
        </div>
    </div>

    <div class="col-md-3">
        <div class="card p-3 shadow text-center bg-warning text-white">
            <h6>Orders</h6>
            <h3>{{ $orders }}</h3>
        </div>
    </div>

    <div class="col-md-3">
        <div class="card p-3 shadow text-center bg-dark text-white">
            <h6>Revenue</h6>
            <h3>₹{{ number_format($revenue) }}</h3>
        </div>
    </div>

</div>


<!-- 🐾 PET REMINDERS -->
<div class="row mb-4">

    <!-- Total -->
    <div class="col-md-3">

        <div class="card p-3 shadow text-center"
             style="
                background:linear-gradient(135deg,#ffecd2,#fcb69f);
                border:none;
                border-radius:18px;
             ">

            <h6 class="text-dark">
                Total Reminders
            </h6>

            <h3 class="fw-bold">
                {{ $totalReminders ?? 0 }}
            </h3>

        </div>

    </div>

    <!-- Upcoming -->
    <div class="col-md-3">

        <div class="card p-3 shadow text-center"
             style="
                background:linear-gradient(135deg,#fff3cd,#ffe082);
                border:none;
                border-radius:18px;
             ">

            <h6 class="text-dark">
                Upcoming
            </h6>

            <h3 class="fw-bold">
                {{ $upcomingReminders ?? 0 }}
            </h3>

        </div>

    </div>

    <!-- Completed -->
    <div class="col-md-3">

        <div class="card p-3 shadow text-center"
             style="
                background:linear-gradient(135deg,#d1fae5,#6ee7b7);
                border:none;
                border-radius:18px;
             ">

            <h6 class="text-dark">
                Completed
            </h6>

            <h3 class="fw-bold">
                {{ $completedReminders ?? 0 }}
            </h3>

        </div>

    </div>

    <!-- Today -->
    <div class="col-md-3">

        <div class="card p-3 shadow text-center"
             style="
                background:linear-gradient(135deg,#dbeafe,#93c5fd);
                border:none;
                border-radius:18px;
             ">

            <h6 class="text-dark">
                Today's Reminders
            </h6>

            <h3 class="fw-bold">
                {{ $todayReminders ?? 0 }}
            </h3>

        </div>

    </div>

</div>


<!-- 🐶 RECENT PET REMINDERS -->
<div class="card p-4 shadow mb-4"
     style="
        border-radius:18px;
     ">

    <div class="d-flex justify-content-between align-items-center mb-4">

        <h5 class="mb-0">
            🐾 Recent Pet Reminders
        </h5>

        <a href="/admin/pet-reminders"
           class="text-primary small text-decoration-none">
            View All →
        </a>

    </div>

    <div class="table-responsive">

        <table class="table align-middle">

            <thead>

                <tr>
                    <th>Pet</th>
                    <th>Type</th>
                    <th>Date</th>
                    <th>Status</th>
                </tr>

            </thead>

            <tbody>

                @forelse($recentReminders ?? [] as $reminder)

                <tr>

                    <td>
                        🐶 {{ $reminder->pet_name }}
                    </td>

                    <td>
                        {{ $reminder->reminder_type }}
                    </td>

                    <td>
                        {{ $reminder->reminder_date }}
                    </td>

                    <td>

                        <span class="badge
                            @if($reminder->status == 'completed')
                                bg-success
                            @else
                                bg-warning text-dark
                            @endif
                        ">

                            {{ ucfirst($reminder->status) }}

                        </span>

                    </td>

                </tr>

                @empty

                <tr>

                    <td colspan="4" class="text-center text-muted">
                        No reminders found
                    </td>

                </tr>

                @endforelse

            </tbody>

        </table>

    </div>

</div>


<!-- 📊 CHARTS -->
<div class="row mb-4">

    <div class="col-md-6">

        <div class="card p-4 shadow chart-card">

            <h6>
                📈 Monthly Orders
            </h6>

            <canvas id="ordersChart"></canvas>

        </div>

    </div>

    <div class="col-md-6">

        <div class="card p-4 shadow chart-card">

            <h6>
                💰 Monthly Revenue
            </h6>

            <canvas id="revenueChart"></canvas>

        </div>

    </div>

</div>


<div class="row mb-4">

    <div class="col-md-6">

        <div class="card p-4 shadow chart-card">

            <h6>
                🧾 Order Status
            </h6>

            <canvas id="statusChart"></canvas>

        </div>

    </div>

</div>


<!-- 🛒 RECENT ORDERS -->
<div class="card p-4 shadow mb-4">

    <div class="d-flex justify-content-between align-items-center mb-4">

        <h5 class="mb-0">
            🛒 Recent Orders
        </h5>

        <a href="/admin/orders" class="text-primary small">
            View All →
        </a>

    </div>

    <div class="row">

        @forelse($recentOrders as $order)

            @php
                $total = $order->items->sum(fn($item) => $item->price * $item->quantity);
                $items = $order->items;
            @endphp

            <div class="col-md-6 mb-3">

                <a href="/admin/order/view/{{ $order->id }}"
                   class="text-decoration-none text-dark">

                    <div class="card order-card h-100">

                        <div class="card-body">

                            <!-- HEADER -->
                            <div class="d-flex justify-content-between mb-2">

                                <strong>
                                    #{{ $order->id }}
                                </strong>

                                <span class="badge
                                    @if($order->status == 'paid') bg-success
                                    @elseif($order->status == 'pending') bg-warning
                                    @elseif($order->status == 'cancelled') bg-danger
                                    @else bg-secondary
                                    @endif
                                ">

                                    {{ ucfirst($order->status) }}

                                </span>

                            </div>

                            <!-- CUSTOMER -->
                            <div class="mb-2 text-muted small">

                                👤 {{ $order->name ?? 'Guest' }}

                            </div>

                            <!-- PRODUCTS -->
                            <div class="mb-2 small">

                                📦

                                @if($items->count())

                                    {{ $items->take(2)->pluck('product_name')->join(', ') }}

                                    @if($items->count() > 2)

                                        <span class="text-muted">
                                            +{{ $items->count() - 2 }} more
                                        </span>

                                    @endif

                                @else

                                    <span class="text-muted">
                                        No items
                                    </span>

                                @endif

                            </div>

                            <!-- DELIVERY -->
                            <div class="mb-3">

                                <span class="badge
                                    @if($order->delivery_status == 'processing') bg-warning text-dark
                                    @elseif($order->delivery_status == 'shipped') bg-info
                                    @elseif($order->delivery_status == 'delivered') bg-success
                                    @elseif($order->delivery_status == 'cancelled') bg-danger
                                    @else bg-secondary
                                    @endif
                                ">

                                    🚚 {{ ucfirst($order->delivery_status ?? 'pending') }}

                                </span>

                            </div>

                            <!-- FOOTER -->
                            <div class="d-flex justify-content-between align-items-center">

                                <strong class="text-success fs-5">

                                    ₹{{ number_format($total) }}

                                </strong>

                                <small class="text-muted">

                                    {{ $order->created_at->diffForHumans() }}

                                </small>

                            </div>

                        </div>

                    </div>

                </a>

            </div>

        @empty

            <p class="text-center text-muted">
                No recent orders found
            </p>

        @endforelse

    </div>

</div>


<!-- 🎨 STYLE -->
<style>

.chart-card {
    border-radius:16px;
    background:linear-gradient(135deg,#ffffff,#f8fafc);
}

.order-card {
    border-radius:14px;
    transition:0.25s;
    border:1px solid #e5e7eb;
}

.order-card:hover {
    transform:translateY(-6px);
    box-shadow:0 10px 25px rgba(0,0,0,0.1);
    border-color:#0d6efd;
}

</style>


<!-- 📊 CHART JS -->
<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>

<script>

const ctx1 = document.getElementById('ordersChart').getContext('2d');

const gradient1 = ctx1.createLinearGradient(0, 0, 0, 300);

gradient1.addColorStop(0, 'rgba(13,110,253,0.4)');
gradient1.addColorStop(1, 'rgba(13,110,253,0.05)');

new Chart(ctx1, {
    type: 'line',
    data: {
        labels: {!! json_encode($months) !!},
        datasets: [{
            data: {!! json_encode($monthlyCounts) !!},
            borderColor: '#0d6efd',
            backgroundColor: gradient1,
            fill: true,
            tension: 0.4
        }]
    }
});

new Chart(document.getElementById('revenueChart'), {
    type: 'bar',
    data: {
        labels: {!! json_encode($months) !!},
        datasets: [{
            data: {!! json_encode($monthlyRevenue) !!},
            backgroundColor: '#198754',
            borderRadius: 8
        }]
    }
});

new Chart(document.getElementById('statusChart'), {
    type: 'doughnut',
    data: {
        labels: ['Processing', 'Shipped', 'Delivered', 'Cancelled'],
        datasets: [{
            data: {!! json_encode($statusCounts) !!},
            backgroundColor: ['#ffc107','#0dcaf0','#198754','#dc3545']
        }]
    }
});

</script>

@endsection