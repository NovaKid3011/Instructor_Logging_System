<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <script src="https://code.jquery.com/jquery-3.7.1.min.js" integrity="sha256-/JqT3SQfawRcv/BIHPThkBvs0OEvtFFmqPF/lYI/Cxo=" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>
    <title>Document</title>
</head>
<body>
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

    <style>
        body {
            overflow-x: hidden;
        }
        #sidebar {
            min-height: 100vh;
        }
        .content {
            padding: 20px;
        }
    </style>

    <div class="container-fluid">
        <div class="row">
            <!-- Sidebar -->
            <nav id="sidebar" class="col-md-3 col-lg-2 d-md-block bg-dark text-white p-3">
                <h2 class="text-center">
                    @if (Auth::check() && Auth::user()->role == '0')
                        User
                    @else
                        Admin
                    @endif
                </h2>
                <ul class="nav flex-column">
                    <li class="nav-item">
                        <div class="dropdown">
                            <button class="btn dropdown-toggle text-white px-3 py-2" type="button" data-bs-toggle="dropdown" aria-expanded="false">
                                {{Auth::user()->first_name}} {{Auth::user()->last_name}}
                            </button>
                            <ul class="dropdown-menu" aria-labelledby="dropdownMenuButton">
                                <li><a href="{{route('profile')}}" class="dropdown-item">Profile</a></li>
                                <li><a href="{{route('logout')}}" class="dropdown-item">Logout</a></li>
                            </ul>
                        </div>
                    </li>
                    <li class="nav-item">
                        <a href="{{route('home')}}" class="nav-link text-white link-primary link-offset-2 link-underline-opacity-25 link-underline-opacity-100-hover">Home</a>
                    </li>
                    <li class="nav-item">
                        @if (Auth::check() && Auth::user()->role == '1')
                            <a href="{{route('users')}}" class="nav-link text-white link-primary link-offset-2 link-underline-opacity-25 link-underline-opacity-100-hover">Users</a>
                        @endif
                    </li>
                </ul>
            </nav>

            <!-- Main Content -->
            <main class="col-md-9 ms-sm-auto col-lg-10 px-md-4 content">
                @yield('content')
            </main>
        </div>
    </div>

</body>
</html>
