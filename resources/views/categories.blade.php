@extends('layouts.app')

@section('content')

<!-- HERO -->

<div style="
    height:40vh;
    background:linear-gradient(rgba(0,0,0,0.5), rgba(0,0,0,0.5)),
    url('{{ asset('images/hero.png') }}') center/cover;
    display:flex;
    align-items:center;
    justify-content:center;
    color:white;
">
    <h1 class="fw-bold">Categories 🐾</h1>
</div>

<!-- CATEGORY GRID -->

<div class="container mt-5 mb-5">

```
<div class="row g-4">

    <!-- DOG -->
    <div class="col-md-4">
        <div class="card shadow h-100">
            <img src="https://images.unsplash.com/photo-1507146426996-ef05306b995a"
                 class="card-img-top"
                 style="height:250px; object-fit:cover;">
            <div class="card-body text-center">
                <h4>Dog Products</h4>
                <a href="#" class="btn btn-dark mt-2">Shop Now</a>
            </div>
        </div>
    </div>

    <!-- CAT -->
    <div class="col-md-4">
        <div class="card shadow h-100">
            <img src="https://images.unsplash.com/photo-1548199973-03cce0bbc87b"
                 class="card-img-top"
                 style="height:250px; object-fit:cover;">
            <div class="card-body text-center">
                <h4>Cat Products</h4>
                <a href="#" class="btn btn-dark mt-2">Shop Now</a>
            </div>
        </div>
    </div>

    <!-- BIRDS -->
    <div class="col-md-4">
        <div class="card shadow h-100">
            <img src="https://images.unsplash.com/photo-1501706362039-c6e80948bb11"
                 class="card-img-top"
                 style="height:250px; object-fit:cover;">
            <div class="card-body text-center">
                <h4>Bird Supplies</h4>
                <a href="#" class="btn btn-dark mt-2">Shop Now</a>
            </div>
        </div>
    </div>

    <!-- FISH -->
    <div class="col-md-4">
        <div class="card shadow h-100">
            <img src="https://images.unsplash.com/photo-1518717758536-85ae29035b6d"
                 class="card-img-top"
                 style="height:250px; object-fit:cover;">
            <div class="card-body text-center">
                <h4>Fish & Aquarium</h4>
                <a href="#" class="btn btn-dark mt-2">Shop Now</a>
            </div>
        </div>
    </div>

    <!-- ACCESSORIES -->
    <div class="col-md-4">
        <div class="card shadow h-100">
            <img src="https://images.unsplash.com/photo-1601758064226-1c3c9c2f02a2"
                 class="card-img-top"
                 style="height:250px; object-fit:cover;">
            <div class="card-body text-center">
                <h4>Accessories</h4>
                <a href="#" class="btn btn-dark mt-2">Shop Now</a>
            </div>
        </div>
    </div>

    <!-- FOOD -->
    <div class="col-md-4">
        <div class="card shadow h-100">
            <img src="https://images.unsplash.com/photo-1583337130417-3346a1c6b6f5"
                 class="card-img-top"
                 style="height:250px; object-fit:cover;">
            <div class="card-body text-center">
                <h4>Pet Food</h4>
                <a href="#" class="btn btn-dark mt-2">Shop Now</a>
            </div>
        </div>
    </div>

</div>
```

</div>

@endsection
