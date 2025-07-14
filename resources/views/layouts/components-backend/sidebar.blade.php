<aside class="left-sidebar with-vertical">
    <div>
        <!-- Start Vertical Layout Sidebar -->
        <div class="brand-logo d-flex align-items-center justify-content-between">
            <a href="./main/index.html" class="text-nowrap logo-img">
                <img src="{{ asset('assets/backend/img/logo.png') }}" class="dark-logo mb-3" alt="Logo-Dark" height="78" />
            </a>
            <a href="javascript:void(0)" class="sidebartoggler ms-auto text-decoration-none fs-5 d-block d-xl-none">
                <i class="ti ti-x"></i>
            </a>
        </div>

        <nav class="sidebar-nav scroll-sidebar" data-simplebar>
            <ul id="sidebarnav">
                <!-- Dashboard -->
                <li class="sidebar-item">
                    <a class="sidebar-link {{ Request::is('admin') ? 'fw-bold text-primary bg-primary-subtle rounded' : '' }}"
                       href="{{ url('admin') }}">
                        <span><i class="ti ti-aperture"></i></span>
                        <span class="hide-menu">Dashboard</span>
                    </a>
                </li>

                <!-- User -->
                <li class="sidebar-item">
                    <a class="sidebar-link {{ Route::is('backend.user.*') ? 'fw-bold text-primary bg-primary-subtle rounded' : '' }}"
                       href="{{ route('backend.user.index') }}">
                        <span><i class="ti ti-aperture"></i></span>
                        <span class="hide-menu">User</span>
                    </a>
                </li>

                <!-- Ruangan -->
                <li class="sidebar-item">
                    <a class="sidebar-link {{ Route::is('backend.ruangan.*') ? 'fw-bold text-primary bg-primary-subtle rounded' : '' }}"
                       href="{{ route('backend.ruangan.index') }}">
                        <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24">
                            <path fill="currentColor"
                                  d="m21.706 5.291-2.999-2.998A1 1 0 0 0 18 2H6a1 1 0 0 0-.707.293L2.294 5.291A1 1 0 0 0 2 6V19c0 1.103.897 2 2 2h16c1.103 0 2-.897 2-2V6a1 1 0 0 0-.294-.709M6.414 4h11.172l.999.999H5.415zM4 19V7h16L20.002 19z" />
                            <path fill="currentColor" d="M15 12H9v-2H7v4h10v-4h-2z" />
                        </svg>
                        <span class="hide-menu">Ruangan</span>
                    </a>
                </li>

                <!-- Jadwal -->
                <li class="sidebar-item">
                    <a class="sidebar-link {{ Route::is('backend.jadwal.*') ? 'fw-bold text-primary bg-primary-subtle rounded' : '' }}"
                       href="{{ route('backend.jadwal.index') }}">
                        <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24">
                            <path fill="currentColor"
                                  d="m21.706 5.291-2.999-2.998A1 1 0 0 0 18 2H6a1 1 0 0 0-.707.293L2.294 5.291A1 1 0 0 0 2 6V19c0 1.103.897 2 2 2h16c1.103 0 2-.897 2-2V6a1 1 0 0 0-.294-.709M6.414 4h11.172l.999.999H5.415zM4 19V7h16L20.002 19z" />
                            <path fill="currentColor" d="M15 12H9v-2H7v4h10v-4h-2z" />
                        </svg>
                        <span class="hide-menu">Jadwal</span>
                    </a>
                </li>

                <!-- Booking -->
                <li class="sidebar-item">
                    <a class="sidebar-link {{ Route::is('backend.bookings.*') ? 'fw-bold text-primary bg-primary-subtle rounded' : '' }}"
                       href="{{ route('backend.bookings.index') }}">
                        <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24">
                            <path fill="currentColor"
                                  d="m21.706 5.291-2.999-2.998A1 1 0 0 0 18 2H6a1 1 0 0 0-.707.293L2.294 5.291A1 1 0 0 0 2 6V19c0 1.103.897 2 2 2h16c1.103 0 2-.897 2-2V6a1 1 0 0 0-.294-.709M6.414 4h11.172l.999.999H5.415zM4 19V7h16L20.002 19z" />
                            <path fill="currentColor" d="M15 12H9v-2H7v4h10v-4h-2z" />
                        </svg>
                        <span class="hide-menu">Booking</span>
                    </a>
                </li>
            </ul>
        </nav>

        <!-- Profile & Logout -->
        <div class="fixed-profile p-3 mx-4 mb-2 bg-secondary-subtle rounded mb-2">
            <div class="hstack gap-3">
                <div class="john-img">
                    <img src="{{ asset('assets/backend/images/profile/user-1.jpg') }}"
                         class="rounded-circle" width="40" height="40" alt="modernize-img" />
                </div>
                <div class="john-title">
                    <h6 class="mb-0 fs-4 fw-semibold">{{ Auth::user()->name }}</h6>
                    <span class="fs-2">{{ Auth::user()->is_admin == 1 ? 'admin' : '' }}</span>
                </div>
                <a href="{{ route('logout') }}"
                   onclick="event.preventDefault(); document.getElementById('logout-form').submit();"
                   class="border-0 bg-transparent text-primary ms-auto" tabindex="0" type="button" aria-label="logout"
                   data-bs-toggle="tooltip" data-bs-placement="top" data-bs-title="logout">
                    <i class="ti ti-power fs-6"></i>
                </a>
                <form action="{{ route('logout') }}" method="post" id="logout-form">
                    @csrf
                </form>
            </div>
        </div>
    </div>
</aside>
