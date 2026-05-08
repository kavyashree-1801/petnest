@extends('layouts.app')

@section('content')

<!-- HERO -->

<div style="
    height:40vh;
    background:linear-gradient(rgba(0,0,0,0.5), rgba(0,0,0,0.5)),
    url('https://t4.ftcdn.net/jpg/17/72/53/07/360_F_1772530708_3XWaS4ibDlKlR8VeK8xDwsafh9pJ5bXx.jpg') center/cover;
    display:flex;
    align-items:center;
    justify-content:center;
    color:white;
">
    <h1 class="fw-bold">Contact Us 🐾</h1>
</div>

<!-- CONTACT FORM -->

<div class="container mt-5 mb-5">
<div class="row justify-content-center">
    <div class="col-md-6">

        <h3 class="mb-4 text-center">Get in Touch</h3>

        @if(session('success'))
            <div class="alert alert-success">
                {{ session('success') }}
            </div>
        @endif

        <form action="{{ route('contact.submit') }}" method="POST">
            @csrf

            <div class="mb-3">
                <label>Name</label>
                <input type="text" name="name" class="form-control" required>
            </div>

            <div class="mb-3">
                <label>Email</label>
                <input type="email" name="email" class="form-control" required>
            </div>

            <div class="mb-3">
                <label>Message</label>
                <textarea name="message" rows="4" class="form-control" required></textarea>
            </div>

            <button class="btn btn-dark w-100">Send Message</button>

        </form>

    </div>
</div>
</div>

@endsection
