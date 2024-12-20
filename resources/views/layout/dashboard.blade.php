@extends('layout.partials._head')

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
                        Admin Dashboard
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
                        @if (Auth::check() && Auth::user()->role == '1')
                            <a href="{{route('users')}}" class="nav-link text-white link-primary link-offset-2 link-underline-opacity-25 link-underline-opacity-100-hover">Users</a>
                        @endif
                    </li>
                    <li class="nav-item">
                    <div class="dropdown">
                            <button class="btn dropdown-toggle text-white px-3 py-2" type="button" data-bs-toggle="dropdown" aria-expanded="false">
                                Reports
                            </button>
                            <ul class="dropdown-menu">
                                <li><a href="{{route(name: 'reports.daily')}}" class="dropdown-item">Daily</a></li>
                                <li><a href="{{route('reports.monthly')}}" class="dropdown-item">Monthly</a></li>
                                <li><a href="{{route('reports.custom')}}" class="dropdown-item">Custom</a></li>
                            </ul>
                        </div>
                    </li>
                </ul>
            </nav>

@endsection
