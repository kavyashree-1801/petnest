@extends('layouts.app')

@section('content')

<div style="
    position:fixed;
    top:0;
    left:0;
    width:100%;
    height:100%;
    background:
    linear-gradient(rgba(255,255,255,0.65), rgba(255,255,255,0.65)),
    url('https://static.vecteezy.com/system/resources/thumbnails/034/243/539/small/dog-accessories-on-yellow-background-top-view-pets-and-animals-concept-photo.jpg');
    background-size:cover;
    background-position:center;
    background-repeat:no-repeat;
    display:flex;
    justify-content:center;
    align-items:center;
">

    <div style="
        background:white;
        padding:40px;
        border-radius:25px;
        width:400px;
        box-shadow:0 15px 40px rgba(0,0,0,0.15);
    ">

        <div class="text-center mb-4">
            <h2 style="
                font-size:42px;
                margin-bottom:10px;
            ">
                🐾
            </h2>

            <h3 class="fw-bold mb-2">
                Forgot Password
            </h3>

            <p style="
                color:#666;
                font-size:14px;
            ">
                Enter your email to receive a password reset link
            </p>
        </div>

        <!-- Success Message -->
        @if (session('status'))
            <div class="alert alert-success">
                {{ session('status') }}
            </div>
        @endif

        <form method="POST" action="{{ route('password.email') }}">
            @csrf

            <!-- Email -->
            <input
                type="email"
                name="email"
                value="{{ old('email') }}"
                class="form-control mb-3"
                placeholder="Enter your email"
                required
                style="
                    height:50px;
                    border-radius:12px;
                "
            >

            @error('email')
                <small class="text-danger d-block mb-3">
                    {{ $message }}
                </small>
            @enderror

            <!-- Button -->
            <button
                type="submit"
                class="btn w-100"
                style="
                    background:#ffbf00;
                    color:black;
                    border-radius:30px;
                    height:50px;
                    font-weight:600;
                    font-size:18px;
                "
            >
                Send Reset Link
            </button>

            <!-- Back -->
            <p class="text-center mt-4 mb-0">
                <a
                    href="{{ route('login') }}"
                    style="
                        text-decoration:none;
                        color:#5c5cff;
                        font-weight:500;
                    "
                >
                    ← Back to Login
                </a>
            </p>

        </form>

    </div>

</div>

@endsection