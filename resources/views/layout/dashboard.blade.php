@extends('layout.partials._head')

<<<<<<< HEAD
    @if(session('error'))
        <script>
            Swal.fire({
                icon: 'error',
                title: 'Oops...',
                text: '{{ session('error') }}',
                confirmButtonText: 'OK'
            });
        </script>
    @endif
    @section("content")
=======

@section('content')

<div class="card m-5 bg-white text-dark">Welcome back!</div>
>>>>>>> e54b95703262526970a816c924966503b6e655a5

@endsection
