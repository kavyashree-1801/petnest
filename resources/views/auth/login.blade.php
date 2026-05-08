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
    url('https://static.vecteezy.com/system/resources/thumbnails/053/215/406/small/happy-corgi-dog-on-a-solid-pastel-blue-background-with-copy-space-photo.jpg');
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

        <h3 class="text-center mb-4 fw-bold">Login</h3>

        <!-- Session Status -->
        @if (session('status'))
            <div class="alert alert-success">
                {{ session('status') }}
            </div>
        @endif

        <form method="POST" action="{{ route('login') }}">
            @csrf

            <!-- Email -->
            <input 
                type="email" 
                name="email" 
                class="form-control mb-3" 
                placeholder="Email"
                value="{{ old('email') }}"
                required
            >

            @error('email')
                <small class="text-danger d-block mb-2">
                    {{ $message }}
                </small>
            @enderror

            <!-- Password -->
            <div style="position:relative;">
                <input 
                    type="password" 
                    id="password" 
                    name="password" 
                    class="form-control mb-3" 
                    placeholder="Password" 
                    required
                >

                <span 
                    onclick="togglePassword()" 
                    style="
                        position:absolute; 
                        right:10px; 
                        top:10px; 
                        cursor:pointer;
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

            <!-- Forgot Password -->
            <div class="text-end mb-3">
                <a 
                    href="{{ route('password.request') }}" 
                    style="
                        font-size:14px;
                        text-decoration:none;
                        color:#6c63ff;
                        font-weight:500;
                    "
                >
                    Forgot Password?
                </a>
            </div>

            <!-- Login Button -->
            <button class="btn btn-warning w-100 rounded-pill">
                Login
            </button>

            <!-- Register -->
            <p class="text-center mt-3 mb-0">
                Don't have an account?
                <a 
                    href="{{ route('register') }}"
                    style="
                        text-decoration:none;
                        color:#6c63ff;
                        font-weight:500;
                    "
                >
                    Create account
                </a>
            </p>

        </form>

    </div>

</div>

<script>
function togglePassword() {
    let input = document.getElementById("password");

    if (input.type === "password") {
        input.type = "text";
    } else {
        input.type = "password";
    }
}
</script>

@endsection