<header class="topbar bg-white shadow-sm sticky-top">
    <div class="with-vertical">
        <nav class="navbar navbar-expand-lg px-3">
            <!-- Sidebar toggle -->
            <button class="btn btn-outline-secondary d-lg-none me-2" id="headerCollapse">
                <i class="ti ti-menu-2 fs-5"></i>
            </button>

            <!-- Toggle dropdown on small screen -->
            <button class="navbar-toggler border-0" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav"
                aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
                <i class="ti ti-dots fs-4"></i>
            </button>

            <!-- Navbar Content -->
            <div class="collapse navbar-collapse justify-content-end" id="navbarNav">
                <ul class="navbar-nav align-items-center gap-2">
                    
                    <!-- User Profile Dropdown -->
                    <li class="nav-item dropdown">
                        <a class="nav-link d-flex align-items-center gap-2" href="#" id="dropUser" role="button"
                           data-bs-toggle="dropdown" aria-expanded="false">
                            <img src="{{ asset('assets/backend/images/profile/user-1.jpg') }}" class="rounded-circle"
                                 width="35" height="35" alt="User" />
                            <span class="d-none d-lg-inline fw-medium">{{ Auth::user()->name }}</span>
                        </a>

                        <ul class="dropdown-menu dropdown-menu-end shadow rounded-4 border-0 mt-2 p-0"
                            aria-labelledby="dropUser" style="min-width: 280px;">
                            
                            <!-- Header Profile Section -->
                            <li class="text-center p-4 bg-light rounded-top">
                                <img src="{{ asset('assets/backend/images/profile/user-1.jpg') }}" class="rounded-circle border border-2 mb-2"
                                     width="80" height="80" alt="User">
                                <h6 class="fw-semibold mb-0">{{ Auth::user()->name }}</h6>
                                <small class="text-muted">{{ Auth::user()->is_admin == 1 ? 'Admin' : 'User' }}</small>
                            </li>

                            <!-- Divider -->
                            <li><hr class="dropdown-divider my-0"></li>

                            <!-- Email Info -->
                            <li class="px-4 py-3">
                                <div class="text-muted small mb-1">Email</div>
                                <div class="d-flex align-items-center text-dark gap-2">
                                    <i class="ti ti-mail fs-5 text-primary"></i>
                                    <span class="small">{{ Auth::user()->email }}</span>
                                </div>
                            </li>

                            <!-- Logout Button -->
                            <li class="px-4 pb-4">
                                <form action="{{ route('logout') }}" method="POST" id="logout-form">
                                    @csrf
                                    <button type="submit" class="btn btn-danger w-100 rounded-pill d-flex align-items-center justify-content-center gap-2">
                                        <i class="ti ti-logout"></i> Logout
                                    </button>
                                </form>
                            </li>
                        </ul>
                    </li>
                </ul>
            </div>
        </nav>
    </div>
</header>
