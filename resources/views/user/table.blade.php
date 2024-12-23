@extends('welcome')
@section('content')
    <div class="container mt-5">
        <table class="table table-striped table-bordered">

            <thead class="table-dark">
                <tr>
                    <th>Name</th>
                </tr>
            </thead>
            <tbody>
                @forelse ($users as $user)
                    <tr>
                        @if ($user->role == 0)
                            <td>
                                <a href="{{ route('sched', $user->id) }}" class="fs-4 px-3 text-black">
                                    {{ $user->first_name }} {{ $user->last_name }}</a>
                            </td>
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
@endsection
