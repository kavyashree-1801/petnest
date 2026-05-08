@extends('layouts.app')

@section('content')

<!-- HERO SECTION -->

<div style="
    height:70vh;
    background:
        linear-gradient(rgba(0,0,0,0.5), rgba(0,0,0,0.5)),
        url('{{ asset('images/hero.png') }}') center/cover;
    display:flex;
    align-items:center;
    justify-content:center;
    color:white;
    text-align:center;
">
    <div>
        <h1 class="fw-bold display-4">About PetNest 🐾</h1>
        <p class="lead">Your trusted pet care partner</p>
    </div>
</div>

<!-- ABOUT SECTION -->

<div class="container mt-5">

```
<div class="row align-items-center">

    <!-- TEXT -->
    <div class="col-md-5">
        <h2 class="fw-bold">Who We Are</h2>
        <p>
            PetNest is your one-stop destination for everything your pets need.
            From nutritious food to toys and accessories, we ensure your pets
            live a happy and healthy life.
        </p>
    </div>

    <!-- BIG IMAGE -->
    <div class="col-md-7">
        <img src="https://encrypted-tbn0.gstatic.com/images?q=tbn:ANd9GcQfcpRX7y459k2EtDVKDNe9-xAdzc9ipO7bQw&s"
             class="img-fluid rounded shadow w-100"
             style="height:400px; object-fit:cover;">
    </div>

</div>
```

</div>

<!-- FEATURES -->

<div class="container mt-5">

```
<h2 class="text-center fw-bold mb-4">Why Choose Us</h2>

<div class="row text-center g-3">

    <div class="col-md-4">
        <div class="p-4 shadow rounded h-100">
            <h4>🐶 Quality Products</h4>
            <p>We provide only the best for your pets.</p>
        </div>
    </div>

    <div class="col-md-4">
        <div class="p-4 shadow rounded h-100">
            <h4>🚚 Fast Delivery</h4>
            <p>Quick and reliable shipping.</p>
        </div>
    </div>

    <div class="col-md-4">
        <div class="p-4 shadow rounded h-100">
            <h4>💖 Pet Care Focus</h4>
            <p>Your pet’s happiness is our priority.</p>
        </div>
    </div>

</div>
```

</div>

<!-- IMAGE SECTION -->

<div class="container mt-5 mb-5">

```
<div class="row g-3">

    <div class="col-md-4">
        <img src="https://images.unsplash.com/photo-1507146426996-ef05306b995a"
             class="img-fluid rounded shadow w-100"
             style="height:250px; object-fit:cover;">
    </div>

    <div class="col-md-4">
        <img src="https://thumbs.dreamstime.com/b/closeup-shot-red-cap-oranda-goldfish-kept-aquarium-pet-shop-fish-store-popular-ornamental-has-silver-white-body-274445200.jpg"
             class="img-fluid rounded shadow w-100"
             style="height:250px; object-fit:cover;">
    </div>

    <div class="col-md-4">
        <img src="https://content.jdmagicbox.com/v2/comp/pune/f3/020pxx20.xx20.190426162010.w9f3/catalogue/ira-persians-pimple-saudagar-pune-pet-shops-for-persian-cat-1l4e83h30p.jpg"
             class="img-fluid rounded shadow w-100"
             style="height:250px; object-fit:cover;">
    </div>

</div>
```

</div>

@endsection
