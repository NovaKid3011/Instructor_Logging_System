

<nav id="sidebar" class=" sidebar">
    <a href="" class="logo p-2">
        <img src="{{asset('/storage/images/Graphics.jpg')}}" width="220px" height="auto" class="py-2" alt="">
    </a>
    <ul class="nav mt-5">
        <li class="{{Request::is('admin/dashboard') ? 'active' : ''}} p-3">
            <div class="">
                <a href="{{route('dashboard')}}" class="nav_btns text-white" style="text-decoration: none">Dashboard
                    <svg  xmlns="http://www.w3.org/2000/svg"  width="15"  height="15"  viewBox="0 0 24 24"  fill="currentColor"  class="icon icon-tabler icons-tabler-filled icon-tabler-layout-dashboard"><path stroke="none" d="M0 0h24v24H0z" fill="none"/><path d="M9 3a2 2 0 0 1 2 2v6a2 2 0 0 1 -2 2h-4a2 2 0 0 1 -2 -2v-6a2 2 0 0 1 2 -2zm0 12a2 2 0 0 1 2 2v2a2 2 0 0 1 -2 2h-4a2 2 0 0 1 -2 -2v-2a2 2 0 0 1 2 -2zm10 -4a2 2 0 0 1 2 2v6a2 2 0 0 1 -2 2h-4a2 2 0 0 1 -2 -2v-6a2 2 0 0 1 2 -2zm0 -8a2 2 0 0 1 2 2v2a2 2 0 0 1 -2 2h-4a2 2 0 0 1 -2 -2v-2a2 2 0 0 1 2 -2z" /></svg>
                </a>
            </div>
        </li>
        <li class="{{Request::is('admin/dashboard/users') ? 'active' : ''}} p-3">
            @if (Auth::check() && Auth::user()->role == '1')
                <a href="{{route('users')}}" class="nav_btns text-white" style="text-decoration: none">Manage Users
                    <svg  xmlns="http://www.w3.org/2000/svg"  width="15"  height="15"  viewBox="0 0 24 24"  fill="none"  stroke="currentColor"  stroke-width="2"  stroke-linecap="round"  stroke-linejoin="round"  class="icon icon-tabler icons-tabler-outline icon-tabler-users"><path stroke="none" d="M0 0h24v24H0z" fill="none"/><path d="M9 7m-4 0a4 4 0 1 0 8 0a4 4 0 1 0 -8 0" /><path d="M3 21v-2a4 4 0 0 1 4 -4h4a4 4 0 0 1 4 4v2" /><path d="M16 3.13a4 4 0 0 1 0 7.75" /><path d="M21 21v-2a4 4 0 0 0 -3 -3.85" /></svg>
                </a>
            @endif
        </li>
        <li class="{{Request::is('') ? 'active' : ''}} p-3">
            <div class="">
                <a href="{{route('instructor')}}" class="nav_btns text-white" style="text-decoration: none">Instructors
                    <svg  xmlns="http://www.w3.org/2000/svg"  width="15"  height="15"  viewBox="0 0 24 24"  fill="none"  stroke="currentColor"  stroke-width="2"  stroke-linecap="round"  stroke-linejoin="round"  class="icon icon-tabler icons-tabler-outline icon-tabler-user"><path stroke="none" d="M0 0h24v24H0z" fill="none"/><path d="M8 7a4 4 0 1 0 8 0a4 4 0 0 0 -8 0" /><path d="M6 21v-2a4 4 0 0 1 4 -4h4a4 4 0 0 1 4 4v2" /></svg>
                </a>
            </div>
        </li>
        <li class="{{Request::is('') ? 'active' : ''}} p-3">
            <div class="">
                <a href="{{route('dashboard')}}" class="nav_btns text-white" style="text-decoration: none">Schedules
                    <svg  xmlns="http://www.w3.org/2000/svg"  width="15"  height="15"  viewBox="0 0 24 24"  fill="none"  stroke="currentColor"  stroke-width="2"  stroke-linecap="round"  stroke-linejoin="round"  class="icon icon-tabler icons-tabler-outline icon-tabler-calendar-event"><path stroke="none" d="M0 0h24v24H0z" fill="none"/><path d="M4 5m0 2a2 2 0 0 1 2 -2h12a2 2 0 0 1 2 2v12a2 2 0 0 1 -2 2h-12a2 2 0 0 1 -2 -2z" /><path d="M16 3l0 4" /><path d="M8 3l0 4" /><path d="M4 11l16 0" /><path d="M8 15h2v2h-2z" /></svg>
                </a>
            </div>
        </li>
        <li class="{{Request::is('') ? 'active' : ''}} p-3">
        <div class="dropdown">
    <a class="nav_btns text-white dropdown-toggle" style="text-decoration: none;" href="#" role="button" id="dropdownMenuLink" data-bs-toggle="dropdown" aria-expanded="false">
        Reports
        <!-- <svg xmlns="http://www.w3.org/2000/svg" width="15" height="15" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="icon icon-tabler icons-tabler-outline icon-tabler-clipboard-text">
            <path stroke="none" d="M0 0h24v24H0z" fill="none"/>
            <path d="M9 5h-2a2 2 0 0 0 -2 2v12a2 2 0 0 0 2 2h10a2 2 0 0 0 2 -2v-12a2 2 0 0 0 -2 -2h-2" />
            <path d="M9 3m0 2a2 2 0 0 1 2 -2h2a2 2 0 0 1 2 2v0a2 2 0 0 1 -2 2h-2a2 2 0 0 1 -2 -2z" />
            <path d="M9 12h6" />
            <path d="M9 16h6" />
        </svg> -->
    </a>
    <ul class="dropdown-menu" aria-labelledby="dropdownMenuLink">
        <li><a class="dropdown-item" href="{{ route('reports.daily') }}">Daily</a></li>
        <li><a class="dropdown-item" href="{{ route('reports.monthly') }}">Monthly</a></li>
        <li><a class="dropdown-item" href="{{ route('reports.custom') }}">Custom</a></li>
    </ul>
</div>

        </li>
    </ul>
</nav>
