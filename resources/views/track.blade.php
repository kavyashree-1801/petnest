@extends('layouts.app')

@section('content')

<div style="
    min-height:100vh;
    overflow-y:auto;
    background:
    linear-gradient(rgba(255,255,255,0.65), rgba(255,255,255,0.65)),
    url('https://images.openai.com/static-rsc-4/995kNLOzbcQtrkSIXUOz2sWIwtS9KSyx6XN5a0ZFgPFapTUf8wNSq_5jYUHPOcbQ29Hz9eJZcK15u1nlaCrYnxTuu6rzk6PkZnms2CawDNn2pVeOo0u_Bht1HZqBAIYILnjq7unNuWIlP8_8fhtDvnltdsbOyl_vcujWThJDYsBMUSx2KHMNuyfZvCGvLKrK?purpose=fullsize');
    background-size:cover;
    background-position:center;
    background-repeat:no-repeat;
    padding:40px 0;
">

<div class="container">

    <!-- HEADING -->
    <div class="text-center mb-5">

        <h2 class="fw-bold"
            style="
                font-size:42px;
                color:#222;
            ">

            🚚 Track Your Order

        </h2>

        <p style="
            color:#555;
            font-size:16px;
        ">

            Track your PetNest order in real time

        </p>

    </div>


    <!-- SEARCH CARD -->
    <div class="mx-auto mb-5"
         style="
            max-width:600px;
            background:white;
            padding:35px;
            border-radius:25px;
            box-shadow:0 10px 30px rgba(0,0,0,0.15);
         ">

        <form method="POST" action="/track">

            @csrf

            <input
                type="text"
                name="tracking_id"
                placeholder="Enter Tracking ID"
                class="form-control mb-3"
                required
                style="
                    height:55px;
                    border-radius:14px;
                    font-size:16px;
                "
            >

            <button
                class="btn w-100"
                style="
                    background:#ffbf00;
                    color:black;
                    height:52px;
                    border-radius:30px;
                    font-size:18px;
                    font-weight:600;
                "
            >

                Track Order

            </button>

        </form>

    </div>


    <!-- RESULT -->
    @if(isset($order))

    @php
        $status = $order->delivery_status ?? 'pending';
    @endphp

    <div class="mx-auto"
         style="
            max-width:1000px;
            background:white;
            padding:40px;
            border-radius:25px;
            box-shadow:0 10px 30px rgba(0,0,0,0.15);
         ">

        <!-- ORDER HEADER -->
        <div class="d-flex justify-content-between align-items-center flex-wrap mb-5">

            <div>

                <h3 class="fw-bold mb-2">

                    Order #{{ $order->id }}

                </h3>

                <p class="mb-0 text-muted">

                    Tracking ID:
                    <strong>{{ $order->tracking_id }}</strong>

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
                font-size:15px;
                padding:12px 20px;
                border-radius:30px;
            ">

                {{ ucfirst($status) }}

            </span>

        </div>


        <!-- DELIVERY DATE -->
        @if($status !== 'cancelled')

        <div class="mb-5">

            <p class="mb-1">

                <strong>📅 Estimated Delivery:</strong>

            </p>

            <h5 style="color:#28a745;">

                {{ $order->delivery_date ?? 'Not Scheduled Yet' }}

            </h5>

        </div>

        @else

        <div class="alert alert-danger mb-5">

            ❌ This order has been cancelled

        </div>

        @endif


        <!-- DELIVERY TIMELINE -->
        <div class="mb-5">

            <div class="d-flex justify-content-between align-items-center flex-wrap">

                <!-- STEP 1 -->
                <div class="text-center flex-fill">

                    <div style="
                        width:65px;
                        height:65px;
                        margin:auto;
                        border-radius:50%;
                        background:#28a745;
                        color:white;
                        display:flex;
                        align-items:center;
                        justify-content:center;
                        font-size:26px;
                        font-weight:bold;
                    ">

                        ✓

                    </div>

                    <p class="mt-3 fw-semibold">

                        Order Placed

                    </p>

                </div>


                <!-- LINE -->
                <div style="
                    flex:1;
                    height:6px;
                    background:
                    {{ in_array($status, ['processing','shipped','delivered']) ? '#28a745' : '#ddd' }};
                    margin:0 10px;
                    border-radius:10px;
                ">
                </div>


                <!-- STEP 2 -->
                <div class="text-center flex-fill">

                    <div style="
                        width:65px;
                        height:65px;
                        margin:auto;
                        border-radius:50%;
                        background:
                        {{ in_array($status, ['processing','shipped','delivered']) ? '#ffc107' : '#ddd' }};
                        color:black;
                        display:flex;
                        align-items:center;
                        justify-content:center;
                        font-size:26px;
                    ">

                        📦

                    </div>

                    <p class="mt-3 fw-semibold">

                        Processing

                    </p>

                </div>


                <!-- LINE -->
                <div style="
                    flex:1;
                    height:6px;
                    background:
                    {{ in_array($status, ['shipped','delivered']) ? '#17a2b8' : '#ddd' }};
                    margin:0 10px;
                    border-radius:10px;
                ">
                </div>


                <!-- STEP 3 -->
                <div class="text-center flex-fill">

                    <div style="
                        width:65px;
                        height:65px;
                        margin:auto;
                        border-radius:50%;
                        background:
                        {{ in_array($status, ['shipped','delivered']) ? '#17a2b8' : '#ddd' }};
                        color:white;
                        display:flex;
                        align-items:center;
                        justify-content:center;
                        font-size:26px;
                    ">

                        🚚

                    </div>

                    <p class="mt-3 fw-semibold">

                        Shipped

                    </p>

                </div>


                <!-- LINE -->
                <div style="
                    flex:1;
                    height:6px;
                    background:
                    {{ $status == 'delivered' ? '#28a745' : '#ddd' }};
                    margin:0 10px;
                    border-radius:10px;
                ">
                </div>


                <!-- STEP 4 -->
                <div class="text-center flex-fill">

                    <div style="
                        width:65px;
                        height:65px;
                        margin:auto;
                        border-radius:50%;
                        background:
                        {{ $status == 'delivered' ? '#28a745' : '#ddd' }};
                        color:white;
                        display:flex;
                        align-items:center;
                        justify-content:center;
                        font-size:26px;
                    ">

                        🏠

                    </div>

                    <p class="mt-3 fw-semibold">

                        Delivered

                    </p>

                </div>

            </div>

        </div>


        <!-- PRODUCTS -->
        <h4 class="fw-bold mb-4">

            🛍 Ordered Items

        </h4>

        <div class="table-responsive">

            <table class="table table-bordered align-middle">

                <thead class="table-light">

                    <tr>

                        <th>Product</th>

                        <th>Qty</th>

                        <th>Price</th>

                    </tr>

                </thead>

                <tbody>

                    @foreach($order->items as $item)

                    <tr>

                        <td>{{ $item->product_name }}</td>

                        <td>{{ $item->quantity }}</td>

                        <td>₹{{ $item->price }}</td>

                    </tr>

                    @endforeach

                </tbody>

            </table>

        </div>

    </div>


    @elseif(request()->isMethod('post'))

    <!-- NOT FOUND -->
    <div class="mx-auto text-center"
         style="
            max-width:500px;
            background:white;
            padding:35px;
            border-radius:25px;
            box-shadow:0 10px 30px rgba(0,0,0,0.15);
         ">

        <h4 class="text-danger fw-bold mb-3">

            ❌ Tracking ID Not Found

        </h4>

        <p class="text-muted">

            Please check your tracking ID and try again.

        </p>

    </div>

    @endif

</div>

</div>

@endsection