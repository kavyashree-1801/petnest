@extends('layouts.app')

@section('content')

<div class="container py-5">

    <div class="row bg-white shadow rounded-4 p-4 align-items-center">

        <!-- IMAGE -->
        <div class="col-md-6">

            <img
                src="{{ $product->image }}"
                class="img-fluid rounded-4"
                style="
                    width:100%;
                    max-height:500px;
                    object-fit:cover;
                "
            >

        </div>

        <!-- CONTENT -->
        <div class="col-md-6">

            <h2 class="fw-bold mb-3">

                {{ $product->name }}

            </h2>

            <div style="
                color:#ffbf00;
                font-size:22px;
            " class="mb-3">

                ⭐⭐⭐⭐☆

            </div>

            <h3 class="text-success fw-bold mb-4">

                ₹{{ $product->price }}

            </h3>

            <p class="text-muted"
               style="
                    line-height:1.9;
                    font-size:16px;
               ">

                {{ $product->description }}

            </p>

            <p class="mt-4">

                <strong>Category:</strong>

                {{ $product->category->name ?? 'No Category' }}

            </p>

            <!-- BUTTONS -->
            <div class="mt-4 d-flex gap-3">

                <form action="/add-to-cart/{{ $product->id }}"
                      method="POST">

                    @csrf

                    <button class="btn btn-warning px-4 py-2 rounded-pill">

                        🛒 Add to Cart

                    </button>

                </form>

                <a href="/products"
                   class="btn btn-outline-dark px-4 py-2 rounded-pill">

                    Back

                </a>

            </div>

        </div>

    </div>

</div>

@endsection