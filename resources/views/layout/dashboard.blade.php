@extends('layout.partials._head')



@section('content')


<div class="m-5 bg-white text-dark">Welcome back!</div>

{{--
    <script>
        fetch(`https://api-portal.mlgcl.edu.ph/api/external/employees?limit=100`, {
            headers: {
                'x-api-key': '{{env('API_KEY')}}'
            }
        }).then(response => response.json())
        .then(response => {
            console.log(response);
        })
    </script> --}}


@endsection
