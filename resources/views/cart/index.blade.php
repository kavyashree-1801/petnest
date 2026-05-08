@extends('layouts.app')

@section('content')

<div style="
    min-height:100vh;
    background:
    linear-gradient(rgba(255,255,255,0.85), rgba(255,255,255,0.85)),
    url('https://t4.ftcdn.net/jpg/13/59/69/57/360_F_1359695719_iTkSsXXjTKmtd6K8llkyDrjzOc2pEViM.jpg');
    background-size:cover;
    background-position:center;
    padding:50px 0;
">

<div class="container">

    <!-- HEADING -->
    <div class="text-center mb-5">

        <h1 class="fw-bold">
            🛒 Your Cart
        </h1>

        <p class="text-muted">
            Review your pet products before checkout
        </p>

    </div>

    @php
        $cart = session()->get('cart', []);
    @endphp


    @if(count($cart) > 0)

    <div class="row">

        <!-- CART ITEMS -->
        <div class="col-lg-8">

            @php $grandTotal = 0; @endphp

            @foreach($cart as $id => $item)

            @php
                $total = $item['price'] * $item['quantity'];
                $grandTotal += $total;
            @endphp

            <div class="bg-white shadow-sm rounded-4 p-4 mb-4">

                <div class="row align-items-center">

                    <!-- INFO -->
                    <div class="col-md-5">

                        <h5 class="fw-bold">

                            {{ $item['name'] }}

                        </h5>

                        <p class="text-success fw-bold mb-0">

                            ₹{{ $item['price'] }}

                        </p>

                    </div>

                    <!-- QUANTITY -->
                    <div class="col-md-3">

                        <div class="d-flex align-items-center justify-content-center gap-2">

                            <!-- DECREASE -->
                            <form action="/update-cart/{{ $id }}"
                                  method="POST">

                                @csrf

                                <input type="hidden"
                                       name="quantity"
                                       value="{{ $item['quantity'] - 1 }}">

                                <button class="btn btn-outline-secondary rounded-circle">

                                    −

                                </button>

                            </form>

                            <span class="fw-bold">

                                {{ $item['quantity'] }}

                            </span>

                            <!-- INCREASE -->
                            <form action="/update-cart/{{ $id }}"
                                  method="POST">

                                @csrf

                                <input type="hidden"
                                       name="quantity"
                                       value="{{ $item['quantity'] + 1 }}">

                                <button class="btn btn-outline-success rounded-circle">

                                    +

                                </button>

                            </form>

                        </div>

                    </div>

                    <!-- TOTAL -->
                    <div class="col-md-2 text-center">

                        <strong>

                            ₹{{ $total }}

                        </strong>

                    </div>

                    <!-- REMOVE -->
                    <div class="col-md-2 text-end">

                        <form action="/remove-from-cart/{{ $id }}"
                              method="POST">

                            @csrf

                            <button class="btn btn-danger rounded-pill btn-sm">

                                Remove

                            </button>

                        </form>

                    </div>

                </div>

            </div>

            @endforeach

        </div>


        <!-- SUMMARY -->
        <div class="col-lg-4">

            <div class="bg-white shadow rounded-4 p-4 position-sticky"
                 style="top:100px;">

                <h4 class="fw-bold mb-4">

                    Order Summary

                </h4>

                <div class="d-flex justify-content-between mb-3">

                    <span>Items</span>

                    <strong>

                        {{ count($cart) }}

                    </strong>

                </div>

                <div class="d-flex justify-content-between mb-4">

                    <span>Total</span>

                    <h4 class="text-success fw-bold">

                        ₹{{ $grandTotal }}

                    </h4>

                </div>

                <a href="/checkout"
                   class="btn btn-success w-100 rounded-pill py-3 fw-semibold">

                    Proceed to Checkout →

                </a>

            </div>

        </div>

    </div>


    @else

    <!-- EMPTY CART -->
    <div class="text-center bg-white shadow rounded-4 p-5 mx-auto"
         style="max-width:600px;">

        <div style="font-size:80px;">
            🛒
        </div>

        <h2 class="fw-bold mt-3">

            Your Cart is Empty

        </h2>

        <p class="text-muted mt-3">

            Looks like you haven’t added any products yet.

        </p>

        <a href="/products"
           class="btn btn-warning rounded-pill px-5 py-3 mt-3">

            Start Shopping

        </a>

    </div>

    @endif

</div>

</div>

@endsection