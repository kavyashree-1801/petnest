@extends('layouts.app')

@section('content')

<div style="
    position:fixed;
    top:0;
    left:0;
    width:100%;
    height:100%;
    background:
    linear-gradient(rgba(255,255,255,0.6), rgba(255,255,255,0.6)),
    url('https://static.vecteezy.com/system/resources/thumbnails/069/701/867/small/low-poly-puppy-a-digital-canine-in-teal-photo.jpg');
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
        border-radius:20px;
        width:350px;
        box-shadow:0 10px 30px rgba(0,0,0,0.2);
    ">

        <h3 class="text-center mb-4 fw-bold">
            Register
        </h3>

        <form method="POST" action="{{ route('register') }}">
            @csrf

            <!-- Name -->
            <input
                type="text"
                name="name"
                class="form-control mb-3"
                placeholder="Name"
                required
            >

            <!-- Email -->
            <input
                type="email"
                name="email"
                class="form-control mb-3"
                placeholder="Email"
                required
            >

            <!-- Password -->
            <div style="position:relative;">

                <input
                    type="password"
                    id="password"
                    name="password"
                    class="form-control mb-3"
                    placeholder="Password"
                    required
                    style="padding-right:45px;"
                >

                <span
                    onclick="togglePassword('password', this)"
                    style="
                        position:absolute;
                        right:10px;
                        top:10px;
                        cursor:pointer;
                        font-size:18px;
                    "
                >
                    👁️
                </span>

            </div>

            <!-- Confirm Password -->
            <div style="position:relative;">

                <input
                    type="password"
                    id="confirmPassword"
                    name="password_confirmation"
                    class="form-control mb-3"
                    placeholder="Confirm Password"
                    required
                    style="padding-right:45px;"
                >

                <span
                    onclick="togglePassword('confirmPassword', this)"
                    style="
                        position:absolute;
                        right:10px;
                        top:10px;
                        cursor:pointer;
                        font-size:18px;
                    "
                >
                    👁️
                </span>

            </div>

            <!-- Button -->
            <button class="btn btn-warning w-100 rounded-pill">
                Register
            </button>

            <!-- Login Link -->
            <p class="text-center mt-3">

                <a
                    href="{{ route('login') }}"
                    style="
                        text-decoration:none;
                        color:#5c5cff;
                        font-weight:500;
                    "
                >
                    Already have account?
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