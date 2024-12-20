@extends('layout.partials._head')

@section('content')

    <div class="catimages">
        <div class="catImages"></div>
    </div>


    {{-- api fetching practice --}}
    {{-- <script>
        fetch(`https://api.thecatapi.com/v1/images/search?limit=10`, {
            headers: {
                'x-api-key': '{{env("API_KEY")}}'
            }
        }).then(res => res.json())
        .then(res => {
            if(res.length > 0){
                res.forEach(cat => {
                    $('.catImages').append(`<div> <img src="${cat.url}" style=float:left width:250px height=250px /> </div>`);
                });
            }
        })
    </script> --}}


@endsection
