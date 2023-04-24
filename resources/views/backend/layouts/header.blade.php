<nav class="navbar navbar-expand d-flex bg-secondary navbar-dark sticky-top px-4 py-0">
                <a href="index.html" class="navbar-brand d-flex d-lg-none me-4 order-0">
                    <h2 class="img-wrp-mob mb-0"><img src="{{asset('backend/assets/img/logo.png')}}" alt=""></h2>
                </a>
                <a href="#" class="sidebar-toggler flex-shrink-0 order-lg-1 order-2 ms-lg-0 ms-4">
                    <i class="fa fa-bars"></i>
                </a>
                <div class="navbar-nav align-items-center ms-auto order-lg-2 order-1">
                    <div class="nav-item dropdown">
                        <a href="#" class="nav-link dropdown-toggle" data-bs-toggle="dropdown">
                            <span class="d-lg-inline-flex">Admin</span>
                        </a>
                        <div class="dropdown-menu dropdown-menu-end bg-secondary rounded-0 rounded-bottom m-0">
                            <!-- <a href="profile.html" class="dropdown-item">My Profile</a> -->
                            <a href="{{route('logout')}}" class="dropdown-item">Log Out</a>
                        </div>
                    </div>
                </div>
            </nav>