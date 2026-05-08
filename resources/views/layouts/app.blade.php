<!DOCTYPE html>
<html>
<head>

    <title>PetNest</title>

    <meta name="viewport" content="width=device-width, initial-scale=1">

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">

    <style>

        body{
            overflow-x:hidden;
        }

        .navbar-brand{
            font-size:28px;
        }

        .nav-link{
            font-weight:500;
        }

        .custom-navbar{
            position:sticky;
            top:0;
            z-index:999;
            backdrop-filter:blur(10px);
        }

        .mobile-btn{
            width:100%;
            margin-top:10px;
        }

        .footer-text{
            color:#d1d5db;
            line-height:1.9;
        }

        .wishlist-link{
            color:rgb(0 0 0 / 65%) !important;
            font-weight:600;
        }

        .dropdown-menu{
            min-width:220px;
        }

        .dropdown-item{
            padding:10px 15px;
            transition:0.2s;
        }

        .dropdown-item:hover{
            background:#f3f4f6;
        }

        @media(max-width:991px){

            .navbar-collapse{
                background:white;
                padding:20px;
                border-radius:20px;
                margin-top:15px;
                box-shadow:0 10px 25px rgba(0,0,0,0.1);
            }

            .nav-item{
                margin-bottom:10px;
            }

            .mobile-center{
                text-align:center;
            }

            .footer-card{
                margin-top:30px;
            }

            .navbar-brand{
                font-size:24px;
            }

        }

    </style>

</head>

<body>

@if (!Request::is('login') &&
     !Request::is('register') &&
     !Request::is('forgot-password') &&
     !Request::is('reset-password/*'))

<!-- NAVBAR -->
<nav class="navbar navbar-expand-lg bg-white shadow-sm custom-navbar">

    <div class="container">

        <!-- LOGO -->
        <a class="navbar-brand fw-bold" href="/">

            🐾 PetNest

        </a>

        <!-- TOGGLER -->
        <button class="navbar-toggler border-0 shadow-none"
                type="button"
                data-bs-toggle="collapse"
                data-bs-target="#nav">

            <span class="navbar-toggler-icon"></span>

        </button>

        <!-- NAV ITEMS -->
        <div class="collapse navbar-collapse justify-content-end"
             id="nav">

            <ul class="navbar-nav align-items-lg-center">

                <!-- HOME -->
                <li class="nav-item">

                    <a class="nav-link" href="/">

                        Home

                    </a>

                </li>

                <!-- ABOUT -->
                <li class="nav-item">

                    <a class="nav-link" href="/about">

                        About

                    </a>

                </li>


                <!-- GUEST -->
                @guest

                    <li class="nav-item ms-lg-3">

                        <a href="{{ route('login') }}"
                           class="btn btn-outline-primary rounded-pill px-4 mobile-btn">

                            Login

                        </a>

                    </li>

                    <li class="nav-item ms-lg-2">

                        <a href="{{ route('register') }}"
                           class="btn btn-warning rounded-pill px-4 mobile-btn">

                            Register

                        </a>

                    </li>

                @endguest



                <!-- AUTH -->
                @auth

                    <!-- USER -->
                    @if(auth()->user()->role === 'user')

                        <!-- PRODUCTS -->
                        <li class="nav-item">

                            <a class="nav-link" href="/products">

                                Products

                            </a>

                        </li>

                        <!-- ORDERS -->
                        <li class="nav-item">

                            <a class="nav-link" href="/orders">

                                My Orders

                            </a>

                        </li>

                        <!-- WISHLIST -->
                        <li class="nav-item">

                            <a class="nav-link wishlist-link"
                               href="/wishlist">

                                ❤️ Wishlist

                            </a>

                        </li>

                        <!-- CART -->
                        <li class="nav-item">

                            <a class="nav-link position-relative"
                               href="/cart">

                                🛒 Cart

                                @if(session('cart'))

                                <span style="
                                    position:absolute;
                                    top:0;
                                    right:-10px;
                                    background:red;
                                    color:white;
                                    font-size:11px;
                                    padding:4px 7px;
                                    border-radius:50%;
                                ">

                                    {{ array_sum(array_column(session('cart'), 'quantity')) }}

                                </span>

                                @endif

                            </a>

                        </li>


                        <!-- MORE DROPDOWN -->
                        <li class="nav-item dropdown">

                            <a class="nav-link dropdown-toggle"
                               href="#"
                               role="button"
                               data-bs-toggle="dropdown">

                                Pet Care 🐾

                            </a>

                            <ul class="dropdown-menu border-0 shadow rounded-4 p-2">

                                <!-- TRACK -->
                                <li>

                                    <a class="dropdown-item rounded-3"
                                       href="/track">

                                        🚚 Track Order

                                    </a>

                                </li>

                                <!-- REMINDERS -->
                                <li>

                                    <a class="dropdown-item rounded-3"
                                       href="/pet-reminders">

                                        🐾 Pet Reminders

                                    </a>

                                </li>

                                <!-- CONTACT -->
                                <li>

                                    <a class="dropdown-item rounded-3"
                                       href="/contact">

                                        📞 Contact

                                    </a>

                                </li>

                                <!-- FEEDBACK -->
                                <li>

                                    <a class="dropdown-item rounded-3"
                                       href="/feedback">

                                        ⭐ Feedback

                                    </a>

                                </li>

                            </ul>

                        </li>

                    @endif



                    <!-- ADMIN -->
                    @if(auth()->user()->role === 'admin')

                        <li class="nav-item">

                            <a class="nav-link fw-bold text-dark"
                               href="/admin">

                                👑 Admin Panel

                            </a>

                        </li>

                    @endif



                    <!-- USER NAME -->
                    <li class="nav-item ms-lg-3">

                        <span class="nav-link fw-bold">

                            👋 {{ auth()->user()->name }}

                        </span>

                    </li>


                    <!-- LOGOUT -->
                    <li class="nav-item ms-lg-2">

                        <form method="POST"
                              action="{{ route('logout') }}">

                            @csrf

                            <button type="submit"
                                    class="btn btn-danger rounded-pill px-4 mobile-btn">

                                Logout

                            </button>

                        </form>

                    </li>

                @endauth

            </ul>

        </div>

    </div>

</nav>

@endif



<!-- PAGE CONTENT -->
@yield('content')



<!-- FOOTER -->
@if (!Request::is('login') &&
     !Request::is('register') &&
     !Request::is('forgot-password') &&
     !Request::is('reset-password/*'))

<footer style="
    background:linear-gradient(135deg,#0f172a,#111827,#1e293b);
    color:white;
    margin-top:60px;
    overflow:hidden;
">

<div class="container py-5">

    <div class="row align-items-center gy-5">

        <!-- LEFT -->
        <div class="col-lg-7 mobile-center">

            <!-- LOGO -->
            <div class="d-flex align-items-center justify-content-lg-start justify-content-center mb-4">

                <div style="
                    width:65px;
                    height:65px;
                    background:rgba(255,255,255,0.08);
                    border-radius:18px;
                    display:flex;
                    align-items:center;
                    justify-content:center;
                    font-size:30px;
                    margin-right:18px;
                ">

                    🐾

                </div>

                <div>

                    <h2 class="fw-bold mb-1"
                        style="
                            font-size:36px;
                        ">

                        PetNest

                    </h2>

                    <span style="
                        color:#cbd5e1;
                        font-size:15px;
                    ">

                        Smart Pet Care & Shopping

                    </span>

                </div>

            </div>

            <!-- DESCRIPTION -->
            <p class="footer-text">

                PetNest helps pet lovers manage pet wellness,
                shopping, grooming essentials, vaccinations,
                reminders and more — all in one place.

            </p>

        </div>


        <!-- RIGHT -->
        <div class="col-lg-5">

            <div class="footer-card"
                 style="
                    background:rgba(255,255,255,0.06);
                    border:1px solid rgba(255,255,255,0.08);
                    border-radius:25px;
                    padding:35px;
                 ">

                <h4 class="fw-bold mb-4 mobile-center">

                    Contact Us

                </h4>

                <!-- EMAIL -->
                <div class="d-flex align-items-center mb-4">

                    <div style="
                        width:45px;
                        height:45px;
                        background:#2563eb;
                        border-radius:12px;
                        display:flex;
                        align-items:center;
                        justify-content:center;
                        margin-right:15px;
                        font-size:20px;
                    ">

                        ✉️

                    </div>

                    <div>

                        <small style="color:#94a3b8;">

                            Email

                        </small>

                        <div class="fw-semibold">

                            support@petnest.com

                        </div>

                    </div>

                </div>


                <!-- PHONE -->
                <div class="d-flex align-items-center mb-4">

                    <div style="
                        width:45px;
                        height:45px;
                        background:#ec4899;
                        border-radius:12px;
                        display:flex;
                        align-items:center;
                        justify-content:center;
                        margin-right:15px;
                        font-size:20px;
                    ">

                        📞

                    </div>

                    <div>

                        <small style="color:#94a3b8;">

                            Phone

                        </small>

                        <div class="fw-semibold">

                            +91 9876543210

                        </div>

                    </div>

                </div>


                <!-- LOCATION -->
                <div class="d-flex align-items-center">

                    <div style="
                        width:45px;
                        height:45px;
                        background:#f59e0b;
                        border-radius:12px;
                        display:flex;
                        align-items:center;
                        justify-content:center;
                        margin-right:15px;
                        font-size:20px;
                    ">

                        📍

                    </div>

                    <div>

                        <small style="color:#94a3b8;">

                            Location

                        </small>

                        <div class="fw-semibold">

                            Bangalore, India

                        </div>

                    </div>

                </div>

            </div>

        </div>

    </div>


    <!-- BOTTOM -->
    <div class="text-center mt-5 pt-4"
         style="
            border-top:1px solid rgba(255,255,255,0.08);
         ">

        <p class="mb-0"
           style="
                color:#cbd5e1;
                letter-spacing:0.5px;
           ">

            © {{ date('Y') }} PetNest. Crafted with ❤️ for pet lovers.

        </p>

    </div>

</div>

</footer>

@endif


<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>

</body>
</html>