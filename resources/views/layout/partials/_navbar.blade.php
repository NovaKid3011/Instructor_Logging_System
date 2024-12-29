<div class="navbar d-flex justify-content-between align-items-center px-3 text-secondary">
    <div class="page-title">
        <h6 class="mb-0">

        @switch(Route::currentRouteName())
            @case('users')
                Users
                @break
            @case('instructor')
                Instructors
                @break
            @case('report')
                Reports
                @break
            @case('schedule')
                Schedule
                @break
            @default
                Dashboard
        @endswitch

        </h6>

    </div>

    <!-- User Dropdown -->
    <div class="navbar-1">
        <ul class="nav">
            <li class="nav-item">
                <div class="dropdown mx-3 pt-2">
                    <a class="nav-link text-black btn dropdown-toggle p-2" data-bs-toggle="dropdown" aria-expanded="false">
                        <small class="text-muted">Admin</small>
                        <div class="border"></div>
                        {{ Auth::user()->first_name }} {{ Auth::user()->last_name }}
                    </a>
                    <ul class="dropdown-menu hover dropdown-menu-lg-end p-1">
                        <a class="dropdown-item" href="" data-bs-toggle="modal" data-bs-target="#logoutModal">
                            <i class="mdi mdi-logout me-2 text-primary"></i> Logout
                        </a>
                    </ul>
                </div>
            </li>
        </ul>
    </div>
</div>
