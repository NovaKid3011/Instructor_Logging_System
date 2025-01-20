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
            @case('instructor.monthly')
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
                <div class="dropdown p-2 d-flex justify-content-center">
                    <a class="nav-link text-black btn dropdown-toggle p-2 d-flex" data-bs-toggle="dropdown" aria-expanded="false">
                        <small class="text-muted">Admin</small>
                        <div class="border"></div>
                        {{ Auth::user()->first_name }} {{ Auth::user()->last_name }}
                    </a>
                    <ul class="dropdown-menu dropdown-menu-lg-end p-0" style="border: none;">
                        <a class="dropdown-item admin-nav p-2" href="" data-bs-toggle="modal" data-bs-target="#logoutModal">
                            <svg class="ms-3" xmlns="http://www.w3.org/2000/svg"  width="20"  height="20"  viewBox="0 0 24 24"  fill="none"  stroke="currentColor"  stroke-width="1"  stroke-linecap="round"  stroke-linejoin="round"  class="icon icon-tabler icons-tabler-outline icon-tabler-logout"><path stroke="none" d="M0 0h24v24H0z" fill="none"/><path d="M14 8v-2a2 2 0 0 0 -2 -2h-7a2 2 0 0 0 -2 2v12a2 2 0 0 0 2 2h7a2 2 0 0 0 2 -2v-2" /><path d="M9 12h12l-3 -3" /><path d="M18 15l3 -3" /></svg>
                            Logout
                        </a>
                    </ul>
                </div>
            </li>
        </ul>
    </div>
</div>
