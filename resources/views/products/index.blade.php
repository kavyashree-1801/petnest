@extends('layouts.app')

@section('content')

<style>

body{
    background:
    linear-gradient(rgba(0,0,0,0.65), rgba(0,0,0,0.75)),
    url('https://t3.ftcdn.net/jpg/13/24/96/34/360_F_1324963406_trhm4Rx5knKaIUMwDJmlYToqcy3bgZPJ.jpg');

    background-size:cover;
    background-position:center;
    background-attachment:fixed;
}

.card{
    border:none;
    border-radius:18px;
    overflow:hidden;
    transition:0.3s;
}

.card:hover{
    transform:translateY(-8px);
    box-shadow:0 15px 35px rgba(0,0,0,0.3);
}

.card img{
    height:220px;
    object-fit:cover;
}

.rating{
    color:#ffbf00;
    font-size:18px;
}

</style>

<div class="container py-5">

    <!-- TITLE -->
    <div class="text-center mb-5">

        <h1 class="fw-bold text-white">
            🐾 PetNest Store
        </h1>

        <p class="text-light">
            Discover premium products for your pets
        </p>

    </div>


    <!-- SEARCH + FILTER -->
    <div class="bg-white p-4 rounded-4 shadow mb-5">

        <form method="GET" action="/products">

            <div class="row g-3">

                <!-- SEARCH -->
                <div class="col-md-4">

                    <input
                        type="text"
                        name="search"
                        value="{{ request('search') }}"
                        class="form-control"
                        placeholder="Search products..."
                        style="height:50px; border-radius:12px;"
                    >

                </div>

                <!-- CATEGORY -->
                <div class="col-md-4">

                    <select
                        name="category"
                        class="form-control"
                        style="height:50px; border-radius:12px;"
                    >

                        <option value="">
                            All Categories
                        </option>

                        @foreach($categories as $category)

                            <option
                                value="{{ $category->id }}"
                                {{ request('category') == $category->id ? 'selected' : '' }}
                            >

                                {{ $category->name }}

                            </option>

                        @endforeach

                    </select>

                </div>

                <!-- SORT -->
                <div class="col-md-2">

                    <select
                        name="sort"
                        class="form-control"
                        style="height:50px; border-radius:12px;"
                    >

                        <option value="">
                            Sort Price
                        </option>

                        <option value="low">
                            Low to High
                        </option>

                        <option value="high">
                            High to Low
                        </option>

                    </select>

                </div>

                <!-- BUTTON -->
                <div class="col-md-2">

                    <button
                        class="btn btn-warning w-100"
                        style="
                            height:50px;
                            border-radius:12px;
                            font-weight:600;
                        "
                    >

                        Search

                    </button>

                </div>

            </div>

        </form>

    </div>


    <!-- PRODUCTS -->
    <div class="row">

        @forelse($products as $product)

        <div class="col-md-3 mb-4">

            <div class="card h-100">

                <!-- IMAGE -->
                <img src="{{ $product->image }}">

                <!-- BODY -->
                <div class="card-body d-flex flex-column">

                    <h5 class="fw-bold">

                        {{ $product->name }}

                    </h5>

                    <!-- RATING -->
                    <div class="rating mb-2">

                        ⭐⭐⭐⭐☆

                    </div>

                    <p class="text-muted small flex-grow-1">

                        {{ Str::limit($product->description, 80) }}

                    </p>

                    <h5 class="text-success fw-bold mb-3">

                        ₹{{ $product->price }}

                    </h5>

                    <!-- BUTTONS -->
                    <!-- BUTTONS -->
<div class="d-grid gap-2">

    <!-- DETAILS -->
    <a href="/products/{{ $product->id }}"
       class="btn btn-outline-dark">

        View Details

    </a>


    <!-- CART -->
    <form action="/add-to-cart/{{ $product->id }}"
          method="POST">

        @csrf

        <button class="btn btn-warning w-100">

            🛒 Add to Cart

        </button>

    </form>


    <!-- WISHLIST -->
    <form action="/wishlist/add/{{ $product->id }}"
          method="POST">

        @csrf

        <button class="btn btn-outline-danger w-100">

            ❤️ Add to Wishlist

        </button>

    </form>

            </div>

                </div>

            </div>

        </div>

        @empty

        <!-- EMPTY -->
        <div class="col-12">

            <div class="bg-white rounded-4 shadow p-5 text-center">

                <h3 class="fw-bold mb-3">
                    No Products Found 🐾
                </h3>

                <p class="text-muted">
                    Try searching with different keywords.
                </p>

            </div>

        </div>

        @endforelse

    </div>

</div>

@endsection