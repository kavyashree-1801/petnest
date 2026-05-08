@extends('layouts.app')

@section('content')

<!-- HERO -->
<div style="position:relative; background:#fdf7f2; overflow:hidden;">

<div class="container py-5">

    <div class="row align-items-center">

        <div class="col-md-6">

            <h1 style="font-size:55px; font-weight:700;">

                Everything <br> Your Pet Needs

            </h1>

            <p class="text-muted mt-3">

                Pet supplies, food, and products from the best manufacturers.

            </p>

            <div class="mt-4">

                <!-- ABOUT -->
                <a href="/about"
                   class="btn btn-warning rounded-pill px-4 py-2">

                    About Us

                </a>

                <!-- SHOP NOW ONLY FOR NORMAL USERS -->
                @auth

                    @if(auth()->user()->role != 'admin')

                        <a href="/products"
                           class="btn btn-outline-primary rounded-pill px-4 py-2 ms-2">

                            Shop Now →

                        </a>

                    @endif

                @endauth

            </div>

        </div>

    </div>

</div>

<!-- CIRCLE -->
<div style="
    position:absolute;
    right:-150px;
    top:50px;
    width:500px;
    height:500px;
    background:#ffe8dc;
    border-radius:50%;
"></div>

<!-- HERO IMAGE -->
<img src="{{ asset('images/home.png') }}"
style="
    position:absolute;
    right:80px;
    bottom:0;
    width:420px;
">

</div>


<!-- ABOUT -->
<div class="container mt-5">

    <div class="row align-items-center bg-white rounded shadow-sm p-4">

        <!-- IMAGE -->
        <div class="col-md-6 text-center">

            <img
                src="https://img.freepik.com/premium-photo/cat-dog-sit-grocery-store_147933-8647.jpg"
                style="
                    width:100%;
                    max-height:350px;
                    object-fit:cover;
                    border-radius:15px;
                "
            >

        </div>

        <!-- CONTENT -->
        <div class="col-md-6">

            <h2 class="fw-bold mb-3">

                About PetNest

            </h2>

            <p class="text-muted">

                PetNest is your trusted online store for all pet essentials.

            </p>

            <a href="/about"
               class="btn btn-warning mt-3 px-4 rounded-pill">

                Learn More

            </a>

        </div>

    </div>

</div>


<!-- GUEST FEATURES -->
@guest

<!-- WHY CHOOSE US -->
<div class="container mt-5">

    <div class="text-center mb-5">

        <h2 class="fw-bold">
            Why Choose PetNest? 🐾
        </h2>

        <p class="text-muted">
            Everything your furry friend needs in one place
        </p>

    </div>

    <div class="row g-4">

        <!-- FAST DELIVERY -->
        <div class="col-md-3">

            <div class="card shadow-sm border-0 p-4 text-center h-100"
                 style="
                    border-radius:20px;
                 ">

                <div style="font-size:45px;">
                    🚚
                </div>

                <h5 class="fw-bold mt-3">
                    Fast Delivery
                </h5>

                <p class="text-muted small">
                    Quick and safe delivery for your pet essentials
                </p>

            </div>

        </div>

        <!-- QUALITY -->
        <div class="col-md-3">

            <div class="card shadow-sm border-0 p-4 text-center h-100"
                 style="
                    border-radius:20px;
                 ">

                <div style="font-size:45px;">
                    ⭐
                </div>

                <h5 class="fw-bold mt-3">
                    Quality Products
                </h5>

                <p class="text-muted small">
                    Trusted and premium quality pet products
                </p>

            </div>

        </div>

        <!-- SUPPORT -->
        <div class="col-md-3">

            <div class="card shadow-sm border-0 p-4 text-center h-100"
                 style="
                    border-radius:20px;
                 ">

                <div style="font-size:45px;">
                    🩺
                </div>

                <h5 class="fw-bold mt-3">
                    Pet Care Support
                </h5>

                <p class="text-muted small">
                    Helpful pet wellness and care reminders
                </p>

            </div>

        </div>

        <!-- PAYMENTS -->
        <div class="col-md-3">

            <div class="card shadow-sm border-0 p-4 text-center h-100"
                 style="
                    border-radius:20px;
                 ">

                <div style="font-size:45px;">
                    🔒
                </div>

                <h5 class="fw-bold mt-3">
                    Secure Payments
                </h5>

                <p class="text-muted small">
                    Safe and secure online payment experience
                </p>

            </div>

        </div>

    </div>

</div>


<!-- CATEGORY PREVIEW -->
<div class="container mt-5">

    <div class="text-center mb-5">

        <h2 class="fw-bold">
            Explore Categories
        </h2>

        <p class="text-muted">
            Discover products for all your lovely pets
        </p>

    </div>

    <div class="row g-4">

        <!-- DOG -->
        <div class="col-md-4">

            <div class="card shadow-sm border-0 text-center p-4 h-100"
                 style="
                    border-radius:20px;
                 ">

                <div style="font-size:55px;">
                    🐶
                </div>

                <h4 class="fw-bold mt-3">
                    Dog Products
                </h4>

                <p class="text-muted">
                    Food, toys, grooming and more
                </p>

            </div>

        </div>

        <!-- CAT -->
        <div class="col-md-4">

            <div class="card shadow-sm border-0 text-center p-4 h-100"
                 style="
                    border-radius:20px;
                 ">

                <div style="font-size:55px;">
                    🐱
                </div>

                <h4 class="fw-bold mt-3">
                    Cat Products
                </h4>

                <p class="text-muted">
                    Essentials for your feline friends
                </p>

            </div>

        </div>

        <!-- FISH -->
        <div class="col-md-4">

            <div class="card shadow-sm border-0 text-center p-4 h-100"
                 style="
                    border-radius:20px;
                 ">

                <div style="font-size:55px;">
                    🐟
                </div>

                <h4 class="fw-bold mt-3">
                    Fish Products
                </h4>

                <p class="text-muted">
                    Aquariums, food and accessories
                </p>

            </div>

        </div>

    </div>

</div>


<!-- REGISTER CTA -->
<div class="container mt-5 mb-5">

    <div class="bg-warning rounded-4 p-5 text-center shadow-sm">

        <h2 class="fw-bold mb-3">
            Join PetNest Today 🐾
        </h2>

        <p class="mb-4">
            Create your account and explore premium pet products and reminders.
        </p>

        <a href="/register"
           class="btn btn-dark rounded-pill px-5 py-2">

            Register Now

        </a>

    </div>

</div>

@endguest

@endsection