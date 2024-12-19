

<div class="navbar flex-row-reverse">
    <ul class="nav">
        <li class="nav-item">
            <div class="dropdown mx-3 pt-2">
                <a class="nav-link text-black btn dropdown-toggle p-2" data-bs-toggle="dropdown" aria-expanded="false">
                    <small class="" style="color: #949494">Admin </small>
                    <div class="border"></div>
                    {{Auth::user()->first_name}} {{Auth::user()->last_name}}
                </a>
                <ul class="dropdown-menu hover dropdown-menu-lg-end" aria-labelledby="dropdownMenuButton">
                    <a class="dropdown-item" href="#" data-toggle="modal" data-target="#editProfile">
                        <i class="mdi mdi-logout me-2 text-primary"></i> Edit Profile
                    </a>
                    <a class="dropdown-item" href="" data-bs-toggle="modal" data-bs-target="#logoutModal">
                        <i class="mdi mdi-logout me-2 text-primary"></i> Logout
                    </a>
                </ul>
            </div>
        </li>
    </ul>
</div>