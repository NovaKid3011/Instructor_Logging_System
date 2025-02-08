

<nav id="sidebar" class="px-1 sidebar">
    <a href="" class="logo d-flex justify-content-center">
        <img src="{{asset('images/logo.png')}}" width="140px" height="auto" class="py-2" alt="photo">
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
        <li class="{{Request::is('admin/dashboard/instructor', 'admin/dashboard/instructor-monthly/*') ? 'active' : ''}} p-3">
            <div class="">
                <a href="{{route('instructor')}}" class="nav_btns text-white" style="text-decoration: none">Instructors
                    <svg  xmlns="http://www.w3.org/2000/svg"  width="15"  height="15"  viewBox="0 0 24 24"  fill="none"  stroke="currentColor"  stroke-width="2"  stroke-linecap="round"  stroke-linejoin="round"  class="icon icon-tabler icons-tabler-outline icon-tabler-user"><path stroke="none" d="M0 0h24v24H0z" fill="none"/><path d="M8 7a4 4 0 1 0 8 0a4 4 0 0 0 -8 0" /><path d="M6 21v-2a4 4 0 0 1 4 -4h4a4 4 0 0 1 4 4v2" /></svg>
                </a>
            </div>
        </li>
        <li class="{{Request::is('admin/report') ? 'active' : ''}} p-3">
            <div class="">
                <a href="{{route('report')}}" class="nav_btns text-white" style="text-decoration: none">Reports
                <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" width="15" height="15" stroke-width="2"> <path d="M9 5h-2a2 2 0 0 0 -2 2v12a2 2 0 0 0 2 2h10a2 2 0 0 0 2 -2v-12a2 2 0 0 0 -2 -2h-2"></path> <path d="M9 3m0 2a2 2 0 0 1 2 -2h2a2 2 0 0 1 2 2v0a2 2 0 0 1 -2 2h-2a2 2 0 0 1 -2 -2z"></path> <path d="M9 12h6"></path> <path d="M9 16h6"></path> </svg>                 </a>
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
                <a class="menus text-decoration-none d-flex justify-content-between align-items-center {{Request::is('admin/dashboard/settings/loggers') ? 'drop-active' : ''}}" href="{{route('loggers')}}">
                    Loggers
                    <svg  xmlns="http://www.w3.org/2000/svg"  width="15"  height="15"  viewBox="0 0 24 24"  fill="none"  stroke="currentColor"  stroke-width="2"  stroke-linecap="round"  stroke-linejoin="round"  class="icon icon-tabler icons-tabler-outline icon-tabler-category-plus"><path stroke="none" d="M0 0h24v24H0z" fill="none"/><path d="M4 4h6v6h-6zm10 0h6v6h-6zm-10 10h6v6h-6zm10 3h6m-3 -3v6" /></svg>
                </a>
            </div>



        </li>
    </ul>
</nav>

<script>
    document.addEventListener('DOMContentLoaded', function() {
        const dropdownBtn = document.querySelector('.dropdown-btn');
        const dropdownContainer = dropdownBtn.nextElementSibling;

        dropdownBtn.addEventListener('click', function() {
            dropdownContainer.classList.toggle('show');
            if (dropdownContainer.classList.contains('show')) {
                dropdownContainer.style.height = dropdownContainer.scrollHeight + 'px';
            } else {
                dropdownContainer.style.height = '0';
            }
        });

        // Prevent the dropdown from closing when a submenu item is clicked
        dropdownContainer.addEventListener('click', function(event) {
            event.stopPropagation();
        });

        // Keep the dropdown open if a submenu item is active
        if (dropdownContainer.querySelector('.drop-active')) {
            dropdownContainer.classList.add('show');
            dropdownContainer.style.height = dropdownContainer.scrollHeight + 'px';
        }
    });
</script>
