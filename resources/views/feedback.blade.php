@extends('layouts.app')

@section('content')

<!-- HERO -->

<div style="
    height:40vh;
    background:linear-gradient(rgba(0,0,0,0.5), rgba(0,0,0,0.5)),
    url('https://t4.ftcdn.net/jpg/02/69/47/89/360_F_269478900_EEEXPJa7ohrxraL6L6V2GlmltteALheQ.jpg') center/cover;
    display:flex;
    align-items:center;
    justify-content:center;
    color:white;
">
    <h1 class="fw-bold">Feedback 🐾</h1>
</div>

<!-- FEEDBACK FORM -->

<div class="container mt-5 mb-5">

```
<div class="row justify-content-center">
    <div class="col-md-6">

        <h3 class="mb-4 text-center">We value your feedback</h3>

        @if(session('success'))
            <div class="alert alert-success">
                {{ session('success') }}
            </div>
        @endif

        <form action="{{ route('feedback.submit') }}" method="POST">
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
                <label>Rating</label>
                <select name="rating" class="form-control" required>
                    <option value="">Select Rating</option>
                    <option value="5">⭐⭐⭐⭐⭐ Excellent</option>
                    <option value="4">⭐⭐⭐⭐ Good</option>
                    <option value="3">⭐⭐⭐ Average</option>
                    <option value="2">⭐⭐ Poor</option>
                    <option value="1">⭐ Bad</option>
                </select>
            </div>

            <div class="mb-3">
                <label>Your Feedback</label>
                <textarea name="message" rows="4" class="form-control" required></textarea>
            </div>

            <button class="btn btn-dark w-100">Submit Feedback</button>

        </form>

    </div>
</div>
```

</div>

@endsection
