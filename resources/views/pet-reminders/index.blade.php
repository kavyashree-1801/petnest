@extends('layouts.app')

@section('content')

<div style="
    min-height:100vh;
    background:
    linear-gradient(rgba(255,255,255,0.75), rgba(255,255,255,0.75)),
    url('https://images.openai.com/static-rsc-4/00TQqGU2BgrYDjIG8V7dOEJkocYK3Nykc68aQcpk2zzFhPwbQADic1-xDvkSud9XYX1Shz2lpqkd2xiok5kq0zgJUMTZ_0mFy5DAkPl4yAZluFbp5br2imvF5ItKNFnGiszvkPiDy2MITqgb_d6o14nez5G0hn17HegpIRQESLJTe_E4NQjnfjbnvkAw7hh-?purpose=fullsize');
    background-size:cover;
    background-position:center;
    padding:40px 0;
">

<div class="container">

    <!-- HEADING -->
    <div class="text-center mb-5">

        <h1 class="fw-bold">
            🐾 Pet Care Reminders
        </h1>

        <p class="text-muted">
            Never miss your pet’s important activities
        </p>

    </div>


    <!-- NOTIFICATION CARDS -->
    <div class="row mb-5">

        <!-- TODAY -->
        <div class="col-md-6 mb-3">

            <div style="
                background:white;
                border-radius:22px;
                padding:25px;
                box-shadow:0 10px 30px rgba(0,0,0,0.12);
            ">

                <div class="d-flex align-items-center">

                    <div style="
                        width:70px;
                        height:70px;
                        background:#fff3cd;
                        border-radius:20px;
                        display:flex;
                        align-items:center;
                        justify-content:center;
                        font-size:32px;
                        margin-right:20px;
                    ">

                        ⏰

                    </div>

                    <div>

                        <h3 class="fw-bold mb-1">

                            {{ $todayReminders }}

                        </h3>

                        <p class="mb-0 text-muted">

                            Reminders For Today

                        </p>

                    </div>

                </div>

            </div>

        </div>


        <!-- UPCOMING -->
        <div class="col-md-6 mb-3">

            <div style="
                background:white;
                border-radius:22px;
                padding:25px;
                box-shadow:0 10px 30px rgba(0,0,0,0.12);
            ">

                <div class="d-flex align-items-center">

                    <div style="
                        width:70px;
                        height:70px;
                        background:#d1ecf1;
                        border-radius:20px;
                        display:flex;
                        align-items:center;
                        justify-content:center;
                        font-size:32px;
                        margin-right:20px;
                    ">

                        📅

                    </div>

                    <div>

                        <h3 class="fw-bold mb-1">

                            {{ $upcomingReminders }}

                        </h3>

                        <p class="mb-0 text-muted">

                            Upcoming Reminders

                        </p>

                    </div>

                </div>

            </div>

        </div>

    </div>


    <!-- SUCCESS -->
    @if(session('success'))

    <div class="alert alert-success text-center mb-4">

        {{ session('success') }}

    </div>

    @endif


    <!-- FORM -->
    <div class="mx-auto mb-5"
         style="
            max-width:700px;
            background:white;
            padding:35px;
            border-radius:25px;
            box-shadow:0 10px 30px rgba(0,0,0,0.15);
         ">

        <h4 class="fw-bold mb-4">

            Add Reminder

        </h4>

        <form method="POST" action="/pet-reminders/store">

            @csrf

            <!-- CATEGORY -->
            <select
                name="category"
                class="form-control mb-3"
                required
                style="
                    height:50px;
                    border-radius:12px;
                "
            >

                <option value="">
                    Select Pet Category
                </option>

                <option value="Dog">
                    🐶 Dog
                </option>

                <option value="Cat">
                    🐱 Cat
                </option>

            </select>


            <!-- PET NAME -->
            <input
                type="text"
                name="pet_name"
                class="form-control mb-3"
                placeholder="Pet Name"
                required
                style="
                    height:50px;
                    border-radius:12px;
                "
            >


            <!-- TYPE -->
            <select
                name="reminder_type"
                class="form-control mb-3"
                required
                style="
                    height:50px;
                    border-radius:12px;
                "
            >

                <option value="">
                    Select Reminder Type
                </option>

                <option>
                    Vaccination
                </option>

                <option>
                    Grooming
                </option>

                <option>
                    Medicine
                </option>

                <option>
                    Vet Visit
                </option>

                <option>
                    Feeding
                </option>

            </select>


            <!-- DATE -->
            <input
                type="date"
                name="reminder_date"
                class="form-control mb-3"
                required
                style="
                    height:50px;
                    border-radius:12px;
                "
            >


            <!-- NOTES -->
            <textarea
                name="notes"
                class="form-control mb-4"
                rows="4"
                placeholder="Example: Vaccination checkup and health consultation..."
                style="
                    border-radius:12px;
                "
            ></textarea>


            <!-- BUTTON -->
            <button
                class="btn w-100"
                style="
                    background:#ffbf00;
                    color:black;
                    height:50px;
                    border-radius:30px;
                    font-weight:600;
                "
            >

                Add Reminder

            </button>

        </form>

    </div>


    <!-- REMINDERS -->
    <div class="row">

        @forelse($reminders as $reminder)

        <div class="col-md-6 mb-4">

            <div style="
                background:white;
                border-radius:25px;
                padding:25px;
                box-shadow:0 10px 30px rgba(0,0,0,0.12);
                height:100%;
            ">

                <!-- TOP -->
                <div class="d-flex justify-content-between align-items-center mb-3">

                    <h4 class="fw-bold mb-0">

                        @if($reminder->category == 'Dog')

                            🐶

                        @else

                            🐱

                        @endif

                        {{ $reminder->pet_name }}

                    </h4>


                    <span class="badge
                        {{ $reminder->status == 'completed'
                            ? 'bg-success'
                            : 'bg-warning text-dark' }}
                    "
                    style="
                        padding:10px 15px;
                        border-radius:20px;
                    ">

                        {{ ucfirst($reminder->status) }}

                    </span>

                </div>


                <!-- CATEGORY -->
                <p class="mb-2">

                    <strong>Category:</strong>

                    {{ $reminder->category }}

                </p>


                <!-- TYPE -->
                <p class="mb-2">

                    <strong>Reminder:</strong>

                    {{ $reminder->reminder_type }}

                </p>


                <!-- DATE -->
                <p class="mb-2">

                    <strong>Date:</strong>

                    {{ $reminder->reminder_date }}

                </p>


                <!-- NOTES -->
                <p class="mb-4">

                    <strong>Notes:</strong>

                    {{ $reminder->notes ?? 'No notes added' }}

                </p>


                <!-- COMPLETE -->
                @if($reminder->status != 'completed')

                <a href="/pet-reminders/complete/{{ $reminder->id }}"
                   class="btn btn-success rounded-pill px-4">

                    Mark as Completed

                </a>

                @endif

            </div>

        </div>

        @empty

        <!-- EMPTY STATE -->
        <div class="col-12">

            <div class="text-center"
                 style="
                    background:white;
                    padding:50px;
                    border-radius:25px;
                    box-shadow:0 10px 30px rgba(0,0,0,0.12);
                 ">

                <div style="font-size:70px;">
                    🐾
                </div>

                <h3 class="fw-bold mt-3">

                    No Reminders Yet

                </h3>

                <p class="text-muted">

                    Add your first pet care reminder to stay organized.

                </p>

            </div>

        </div>

        @endforelse

    </div>

</div>

</div>

@endsection