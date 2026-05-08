@extends('layouts.admin')

@section('title', 'Contacts')

@section('content')

<div class="card shadow p-4">
    <h5 class="mb-3">📩 Contacts</h5>

    @foreach($contacts as $contact)
        <div class="border-bottom py-2 d-flex justify-content-between">
            <div>
                <strong>{{ $contact->name }}</strong><br>
                <small>{{ $contact->message }}</small>
            </div>

            <a href="/admin/delete-contact/{{ $contact->id }}"
               class="btn btn-sm btn-danger"
               onclick="return confirm('Delete?')">
               Delete
            </a>
        </div>
    @endforeach

    {{ $contacts->links() }}
</div>

@endsection