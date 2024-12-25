

<nav id="sidebar" class="px-1 sidebar">
    <a href="" class="logo d-flex justify-content-center">
        <img src="{{asset('/storage/images/logo.png')}}" width="140px" height="auto" class="py-2" alt="">
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
        <li class="{{Request::is('admin/dashboard/instructor') ? 'active' : ''}} p-3">
            <div class="">
                <a href="{{route('instructor')}}" class="nav_btns text-white" style="text-decoration: none">Instructors
                    <svg  xmlns="http://www.w3.org/2000/svg"  width="15"  height="15"  viewBox="0 0 24 24"  fill="none"  stroke="currentColor"  stroke-width="2"  stroke-linecap="round"  stroke-linejoin="round"  class="icon icon-tabler icons-tabler-outline icon-tabler-user"><path stroke="none" d="M0 0h24v24H0z" fill="none"/><path d="M8 7a4 4 0 1 0 8 0a4 4 0 0 0 -8 0" /><path d="M6 21v-2a4 4 0 0 1 4 -4h4a4 4 0 0 1 4 4v2" /></svg>
                </a>
            </div>
        </li>
        <li class="{{Request::is('admin/dashboard/schedules') ? 'active' : ''}} p-3">
            <div class="">
                <a href="{{route('schedules')}}" class="nav_btns text-white" style="text-decoration: none">Schedules
                    <svg  xmlns="http://www.w3.org/2000/svg"  width="15"  height="15"  viewBox="0 0 24 24"  fill="none"  stroke="currentColor"  stroke-width="2"  stroke-linecap="round"  stroke-linejoin="round"  class="icon icon-tabler icons-tabler-outline icon-tabler-calendar-event"><path stroke="none" d="M0 0h24v24H0z" fill="none"/><path d="M4 5m0 2a2 2 0 0 1 2 -2h12a2 2 0 0 1 2 2v12a2 2 0 0 1 -2 2h-12a2 2 0 0 1 -2 -2z" /><path d="M16 3l0 4" /><path d="M8 3l0 4" /><path d="M4 11l16 0" /><path d="M8 15h2v2h-2z" /></svg>
                </a>
            </div>
        </li>
            <li class="p-3">
                <div class="dropdown  dropdown-menu-lg-end">
                <a class="nav_btns text-white dropdown-toggle" style="text-decoration: none;" href="#" id="dropdownMenuLink" data-bs-toggle="dropdown" aria-expanded="false">
                    Reports
                </a>
                    <ul class="dropdown-menu p-1" aria-labelledby="dropdownMenuLink">
                        <li><a class="dropdown-item {{Request::is('admin/reports/daily') ? 'drop-active' : ''}}" href="{{ route('reports.daily') }}">Daily</a></li>
                        <li><a class="dropdown-item" href="{{ route('reports.monthly') }}">Monthly</a></li>
                        <li><a class="dropdown-item" href="{{ route('reports.custom') }}">Custom</a></li>
                    </ul>
                </div>
            </li>

            <button class="dropdown-btn d-flex justify-content-between align-items-center">Settings
                <svg  xmlns="http://www.w3.org/2000/svg"  width="9"  height="9"  viewBox="0 0 24 24"  fill="currentColor"  class="icon icon-tabler icons-tabler-filled icon-tabler-caret-down"><path stroke="none" d="M0 0h24v24H0z" fill="none"/><path d="M18 9c.852 0 1.297 .986 .783 1.623l-.076 .084l-6 6a1 1 0 0 1 -1.32 .083l-.094 -.083l-6 -6l-.083 -.094l-.054 -.077l-.054 -.096l-.017 -.036l-.027 -.067l-.032 -.108l-.01 -.053l-.01 -.06l-.004 -.057v-.118l.005 -.058l.009 -.06l.01 -.052l.032 -.108l.027 -.067l.07 -.132l.065 -.09l.073 -.081l.094 -.083l.077 -.054l.096 -.054l.036 -.017l.067 -.027l.108 -.032l.053 -.01l.06 -.01l.057 -.004l12.059 -.002z" /></svg>
            </button>
            <div class="dropdown-container sub-menu">
                <a class="menus text-decoration-none d-flex justify-content-between align-items-center {{Request::is('admin/dashboard/manage-email') ? 'drop-active' : ''}}" href="{{route('manage-emails')}}">
                    Mails
                    <svg  xmlns="http://www.w3.org/2000/svg"  width="15"  height="15"  viewBox="0 0 24 24"  fill="none"  stroke="currentColor"  stroke-width="2"  stroke-linecap="round"  stroke-linejoin="round"  class="icon icon-tabler icons-tabler-outline icon-tabler-mail-share"><path stroke="none" d="M0 0h24v24H0z" fill="none"/><path d="M13 19h-8a2 2 0 0 1 -2 -2v-10a2 2 0 0 1 2 -2h14a2 2 0 0 1 2 2v6" /><path d="M3 7l9 6l9 -6" /><path d="M16 22l5 -5" /><path d="M21 21.5v-4.5h-4.5" /></svg>
                </a>
            </div>



        </li>
    </ul>
</nav>

<script>
    document.querySelector('.dropdown-btn').addEventListener('click', function () {
        const dropdownContainer = this.nextElementSibling;

        if (dropdownContainer.style.height && dropdownContainer.style.height !== '0px') {
            // If dropdown is open, close it
            dropdownContainer.style.height = '0';
        } else {
            // If dropdown is closed, open it
            dropdownContainer.style.height = dropdownContainer.scrollHeight + 'px';
        }
    });
</script>
