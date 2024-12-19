@extends('welcome')
@section('user')

<div class="container mt-5">
    <div class="card">
        <div class="card-header bg-primary text-white">
            <h5 class="mb-0">Instructor</h5>
        </div>
        <div class="card-body">
            <table class="table table-striped table-bordered">

                <thead class="table-dark">
                    <tr>
                        <th>First Name</th>
                        <th>Last Name</th>
                        <th>Action</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse ($users as $user)
                            <tr>
                                @if ($user->role == 0)
                                    <td>{{ $user->first_name }}</td>
                                    <td>{{ $user->last_name }}</td>
                                @else


                                @endif
                            </tr>
                        @empty
                            <tr>
                                <td colspan="4" class="text-center">No users found.</td>
                            </tr>
                        @endforelse
                </tbody>
            </table>
        </div>
    </div>
</div>

@endsection
