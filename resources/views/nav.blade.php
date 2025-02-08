<nav class="navbar navbar-expand-lg" style="background-color: #4E73DF; position: sticky; top: 0;">
    <div class="container-fluid">
        <a href="" class="logo d-flex justify-content-center">
            <img src="{{asset('images/logo.png')}}" width="140px" height="auto" class="py-2" alt="">
        </a>
        <div class="collapse navbar-collapse" id="navbarSupportedContent">
            <ul class="navbar-nav">
            </ul>
        </div>
        <div class="dropdown mx-3 pt-2">
            <a class="nav-link text-light btn dropdown-toggle p-2" data-bs-toggle="dropdown" aria-expanded="false">
                {{Auth::user()->first_name}} {{Auth::user()->last_name}}
            </a>
            <ul class="dropdown-menu nav-menu dropdown-menu-lg-end" aria-labelledby="dropdownMenuButton">
                <a class="dropdown-item text-dark" href="" data-bs-toggle="modal" data-bs-target="#logoutModal">
                    <i class="mdi mdi-logout me-2 text-primary"></i> Logout
                </a>
            </ul>
        </div>
    </div>
</nav>
