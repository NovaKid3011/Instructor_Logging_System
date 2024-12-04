<nav class="navbar navbar-expand-lg bg-body-tertiary">
    <div class="container-fluid">
        <a class="navbar-brand" href="#">Laravel</a>
        <div class="collapse navbar-collapse" id="navbarSupportedContent">
            <ul class="navbar-nav">
            </ul>
        </div>
        <div class="d-flex">
            @guest
                <div class="mx-2">
                    <a class="nav-link text-black link-primary link-offset-2 link-underline-opacity-25 link-underline-opacity-100-hover"
                        href="{{ route('login') }}">Login</a>
                </div>
                <div class="mx-2">
                    <a class="nav-link text-black link-primary link-offset-2 link-underline-opacity-25 link-underline-opacity-100-hover"
                        href="{{ route('register') }}">Register</a>
                </div>
            @endguest
            @auth
                <div class="dropdown">
                    <button class="btn dropdown-toggle" type="button" data-bs-toggle="dropdown" aria-expanded="false">
                        {{ Auth::user()->first_name }} {{ Auth::user()->last_name }}
                    </button>
                    <ul class="dropdown-menu dropdown-menu-end">
                        <li>
                            @if (Auth::check() && Auth::user()->role == '1')
                                <a class="dropdown-item" href="{{ route('dashboard') }}">Dashboard</a>
                            @endif
                        </li>
                        <li><a class="dropdown-item" href="{{ route('logout') }}">Logout</a></li>
                    </ul>
                </div>
            @endauth
        </div>
    </div>
</nav>
