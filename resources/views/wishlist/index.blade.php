@extends('layouts.app')

@section('content')

<div style="
    min-height:100vh;
    background:
    linear-gradient(rgba(255,255,255,0.82), rgba(255,255,255,0.82)),
    url('https://t4.ftcdn.net/jpg/18/79/24/61/360_F_1879246139_09kAzcEcfzDUHWKX4v6Wtx0xdrAI8pFh.jpg');

    background-size:cover;
    background-position:center;
    background-attachment:fixed;
    padding:50px 0;
">

<div class="container">

    <!-- TITLE -->
    <div class="text-center mb-5">

        <h1 class="fw-bold"
            style="
                font-size:48px;
                color:#222;
            ">

            ❤️ My Wishlist

        </h1>

        <p class="text-muted"
           style="
                font-size:18px;
           ">

            Your favorite pet products

        </p>

    </div>


    <div class="row">

        @forelse($wishlists as $wishlist)

        <div class="col-md-3 mb-4">

            <div class="card border-0 shadow rounded-4 h-100"
                 style="
                    overflow:hidden;
                    transition:0.3s;
                 ">

                <!-- IMAGE -->
                <img
                    src="{{ $wishlist->product->image }}"
                    style="
                        height:240px;
                        object-fit:cover;
                    "
                >

                <!-- BODY -->
                <div class="card-body d-flex flex-column">

                    <h5 class="fw-bold mb-3">

                        {{ $wishlist->product->name }}

                    </h5>

                    <!-- RATING -->
                    <div style="
                        color:#ffbf00;
                        font-size:18px;
                    "
                    class="mb-2">

                        ⭐⭐⭐⭐☆

                    </div>

                    <p class="text-success fw-bold fs-5">

                        ₹{{ $wishlist->product->price }}

                    </p>

                    <div class="mt-auto d-grid gap-2">

                        <!-- CART -->
                        <form action="/add-to-cart/{{ $wishlist->product->id }}"
                              method="POST">

                            @csrf

                            <button class="btn btn-warning w-100 rounded-pill">

                                🛒 Add to Cart

                            </button>

                        </form>


                        <!-- REMOVE -->
                        <form action="/wishlist/remove/{{ $wishlist->product->id }}"
                              method="POST">

                            @csrf

                            <button class="btn btn-danger w-100 rounded-pill">

                                Remove

                            </button>

                        </form>

                    </div>

                </div>

            </div>

        </div>

        @empty

        <!-- EMPTY -->
        <div class="col-12">

            <div class="text-center bg-white shadow rounded-4 p-5 mx-auto"
                 style="
                    max-width:650px;
                 ">

                <div style="font-size:80px;">
                    ❤️
                </div>

                <h2 class="fw-bold mt-3">

                    Wishlist is Empty

                </h2>

                <p class="text-muted mt-3">

                    Save your favorite pet products here
                    and access them anytime.

                </p>

                <a href="/products"
                   class="btn btn-warning rounded-pill px-5 py-3 mt-3">

                    Explore Products

                </a>

            </div>

        </div>

        @endforelse

    </div>

</div>

</div>

@endsection