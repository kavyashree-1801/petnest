@extends('layouts.admin')

@section('title', 'Pet Reminders')

@section('content')

<h4 class="mb-4">
    🐾 Pet Reminders
</h4>

<div class="card p-4 shadow"
     style="
        border-radius:18px;
     ">

    <div class="table-responsive">

        <table class="table align-middle">

            <thead>

                <tr>
                    <th>Category</th>
                    <th>Pet</th>
                    <th>Reminder Type</th>
                    <th>Date</th>
                    <th>Status</th>
                </tr>

            </thead>

            <tbody>

                @forelse($reminders as $reminder)

                <tr>

                    <!-- CATEGORY -->
                    <td>

                        @if($reminder->category == 'Dog')

                            <span class="badge bg-primary px-3 py-2">
                                🐶 Dog
                            </span>

                        @else

                            <span class="badge bg-dark px-3 py-2">
                                🐱 Cat
                            </span>

                        @endif

                    </td>

                    <!-- PET -->
                    <td class="fw-semibold">

                        {{ $reminder->pet_name }}

                    </td>

                    <!-- TYPE -->
                    <td>

                        {{ $reminder->reminder_type }}

                    </td>

                    <!-- DATE -->
                    <td>

                        {{ $reminder->reminder_date }}

                    </td>

                    <!-- STATUS -->
                    <td>

                        <span class="badge
                            @if($reminder->status == 'completed')
                                bg-success
                            @else
                                bg-warning text-dark
                            @endif
                        ">

                            {{ ucfirst($reminder->status) }}

                        </span>

                    </td>

                </tr>

                @empty

                <tr>

                    <td colspan="5" class="text-center text-muted py-4">

                        No reminders found 🐾

                    </td>

                </tr>

                @endforelse

            </tbody>

        </table>

    </div>

    <!-- PAGINATION -->
    <div class="mt-4">

        {{ $reminders->links() }}

    </div>

</div>

@endsection