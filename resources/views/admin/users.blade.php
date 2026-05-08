@extends('layouts.admin')

@section('title', 'Users')

@section('content')

<div class="card shadow p-4">
    <h5 class="mb-3">👥 Users</h5>

    <table class="table">
        <thead>
            <tr>
                <th>ID</th>
                <th>Name</th>
                <th>Email</th>
                <th width="120">Action</th>
            </tr>
        </thead>

        <tbody>
            @foreach($users as $user)
            <tr>
                <td>{{ $user->id }}</td>
                <td>{{ $user->name }}</td>
                <td>{{ $user->email }}</td>
                <td>
                    <a href="/admin/delete-user/{{ $user->id }}" 
                       class="btn btn-sm btn-danger"
                       onclick="return confirm('Delete this user?')">
                       Delete
                    </a>
                </td>
            </tr>
            @endforeach
        </tbody>
    </table>

    {{ $users->links() }}
</div>

@endsection