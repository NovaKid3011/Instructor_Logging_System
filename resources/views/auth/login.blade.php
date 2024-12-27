@extends('layout.default')
@section('title', 'Login')
@section('content')
    @if(session('success'))
        <script>
            Swal.fire({
                icon: 'success',
                title: 'Success!',
                text: '{{ session('success') }}',
                confirmButtonText: 'OK'
            });
        </script>
    @endif

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

    <main class="m-0">
        <div class=" login_form d-flex justify-content-center  align-items-center position-absolute top-50 start-50 translate-middle">
            <div class="">
                <a href="" class="logo">
                    <img src="{{asset('/images/mlg-logo.png')}}" width="150px" height="auto" class="" alt="">
                </a>
                <div class="card-body col-12">
                    <form action="{{route('login.post')}}" method="POST">
                        @csrf
                        <div class="form-group mb-4">
                            <input type="email" placeholder="Email" id="email" class="form-control" name="email" required autofocus>
                            @if ($errors->has('email'))
                                <span class="text-danger">{{ $errors->first('email') }}</span>
                            @endif
                        </div>
                        <div class="form-group mb-4">
                            <input type="password" placeholder="Password" id="password" class="form-control" name="password" required autofocus>
                            @if ($errors->has('password'))
                                <span class="text-danger">{{ $errors->first('password') }}</span>
                            @endif
                        </div>
                        <div class="d-grid mx-auto mb-4 shadow bg-body-tertiary rounded">
                            <button type="submit" class="btn btn-primary log-button text-light">Login</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
        <div class="school_image">

            <!-- <img src="{{asset('/storage/images/school.png')}}" width="100%" height="100%" class="" alt=""> -->
            <img src="{{asset('/storage/images/school.jpg')}}" width="100%" height="100%" class="" alt="">
        </div>
    </main>

        {{-- api fetching practice --}}
    <script>
        // fetch(`https://api.thecatapi.com/v1/images/search?limit=10`, {
        //     headers: {
        //         'x-api-key': '{{env("API_KEY")}}'
        //     }
        // }).then(res => res.json())
        // .then(res => {
        //     if(res.length > 0){
        //         res.forEach(cat => {
        //             $('.school-image').append(`<div> <img src="${cat.url}" style=width:100% height:100vh /> </div>`);
        //         });

        //         $(document).ready(function() {
        //             $('.school-image').slick({
        //                 autoplay: true,
        //                 infinite: true,
        //                 speed: 8000,
        //                 fade: true,
        //                 cssEase: 'linear',
        //                 arrows: false,
        //             });
        //         });
        //     }
        // })
    </script>


    <script>


    </script>

@endsection
