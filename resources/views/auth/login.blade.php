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
        <div class="bg-cover">
            <img src="{{asset("images/school.png")}}" alt="">
        </div>
        <div class=" login_form d-flex justify-content-center">
            <a href="" class="logo">
                <img src="{{asset("images/one student.png")}}" width="300px" alt="">
                <img src="{{asset('/images/login_logo.png')}}" width="250px" height="auto" class="" alt="">
            </a>
            <div class="login_card loginForm">
                <div class="formInput">
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
                        <div class="d-grid mx-auto mb-4 shadow bg-body-tertiary rounded col-4">
                            <button type="submit" class="btn btn-primary log-button text-light">Login</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </main>

    <script>


    </script>

@endsection
