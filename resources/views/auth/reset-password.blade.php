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
    url('https://img.freepik.com/free-photo/pet-accessories-still-life-concept-with-various-grooming-objects-treats_23-2148949575.jpg?semt=ais_hybrid&w=740&q=80');
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

        <!-- Header -->
        <div class="text-center mb-4">

            <h2 style="
                font-size:42px;
                margin-bottom:10px;
            ">
                🐶
            </h2>

            <h3 class="fw-bold mb-2">
                Reset Password
            </h3>

            <p style="
                color:#666;
                font-size:14px;
            ">
                Create a new secure password for your account
            </p>

        </div>

        <!-- Form -->
        <form method="POST" action="{{ route('password.store') }}">
            @csrf

            <!-- Token -->
            <input
                type="hidden"
                name="token"
                value="{{ $request->route('token') }}"
            >

            <!-- Email -->
            <input
                type="email"
                name="email"
                value="{{ old('email', $request->email) }}"
                class="form-control mb-3"
                placeholder="Email"
                required
                autofocus
                style="
                    height:50px;
                    border-radius:12px;
                "
            >

            @error('email')
                <small class="text-danger d-block mb-2">
                    {{ $message }}
                </small>
            @enderror

            <!-- New Password -->
            <div style="position:relative;">

                <input
                    type="password"
                    name="password"
                    id="password"
                    class="form-control mb-3"
                    placeholder="New Password"
                    required
                    style="
                        height:50px;
                        border-radius:12px;
                        padding-right:45px;
                    "
                >

                <span
                    onclick="togglePassword('password', this)"
                    style="
                        position:absolute;
                        right:15px;
                        top:12px;
                        cursor:pointer;
                        font-size:20px;
                    "
                >
                    👁️
                </span>

            </div>

            @error('password')
                <small class="text-danger d-block mb-2">
                    {{ $message }}
                </small>
            @enderror

            <!-- Confirm Password -->
            <div style="position:relative;">

                <input
                    type="password"
                    name="password_confirmation"
                    id="confirmPassword"
                    class="form-control mb-4"
                    placeholder="Confirm Password"
                    required
                    style="
                        height:50px;
                        border-radius:12px;
                        padding-right:45px;
                    "
                >

                <span
                    onclick="togglePassword('confirmPassword', this)"
                    style="
                        position:absolute;
                        right:15px;
                        top:12px;
                        cursor:pointer;
                        font-size:20px;
                    "
                >
                    👁️
                </span>

            </div>

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
                Reset Password
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

<!-- Toggle Password Script -->
<script>
function togglePassword(inputId, icon) {

    let input = document.getElementById(inputId);

    if (input.type === "password") {
        input.type = "text";
        icon.innerHTML = "🙈";
    } else {
        input.type = "password";
        icon.innerHTML = "👁️";
    }

}
</script>

@endsection