@extends('layouts.admin')

@section('title', 'Feedback')

@section('content')

<div class="card shadow p-4">
    <h5 class="mb-3">💬 Feedback</h5>

    @foreach($feedbacks as $feedback)
        <div class="border-bottom py-2 d-flex justify-content-between">
            <div>
                <strong>{{ $feedback->name }}</strong><br>
                <small>{{ $feedback->message }}</small>
            </div>

            <a href="/admin/delete-feedback/{{ $feedback->id }}"
               class="btn btn-sm btn-danger"
               onclick="return confirm('Delete?')">
               Delete
            </a>
        </div>
    @endforeach

    {{ $feedbacks->links() }}
</div>

@endsection