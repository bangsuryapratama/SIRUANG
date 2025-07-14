<header class="shadow-sm">
  <nav class="navbar navbar-expand-lg bg-white py-3">
    <div class="container">
      <!-- Logo -->
      <a class="navbar-brand d-flex align-items-center gap-2" href="{{ url('/') }}">
        <img src="{{ asset('assets/backend/img/logo.png') }}" alt="Logo" height="45">
        <span class="fw-bold text-dark d-none d-md-inline"></span>
      </a>

      <!-- Toggle Button -->
      <button class="navbar-toggler border-0" type="button" data-bs-toggle="collapse" data-bs-target="#navbarContent">
        <i class="ti ti-menu-2 fs-4 text-dark"></i>
      </button>

      <!-- Navbar Content -->
      <div class="collapse navbar-collapse" id="navbarContent">
        <!-- Centered Menu -->
        <ul class="navbar-nav mx-auto gap-lg-4">
          <li class="nav-item"><a class="nav-link text-dark fw-semibold" href="{{ url('/') }}">Beranda</a></li>
          <li class="nav-item"><a class="nav-link text-dark fw-semibold" href="{{ route('bookings.create') }}">Booking</a></li>
          <li class="nav-item"><a class="nav-link text-dark fw-semibold" href="{{ route('ruangan') }}">Ruangan</a></li>
          @auth
            <li class="nav-item"><a class="nav-link text-dark fw-semibold" href="{{ route('bookings.riwayat') }}">Riwayat</a></li>
          @endauth
        </ul>

        <!-- Right Side: Auth -->
        <ul class="navbar-nav ms-auto">
          @guest
            <li class="nav-item">
              <a href="{{ route('login') }}" class="btn btn-outline-primary rounded-pill px-4 fw-semibold">Login</a>
            </li>
          @else
            <li class="nav-item dropdown">
              <a class="nav-link dropdown-toggle d-flex align-items-center gap-2" href="#" id="userDropdown" role="button"
                 data-bs-toggle="dropdown" aria-expanded="false">
                <img src="{{ asset('assets/backend/images/profile/user-1.jpg') }}" class="rounded-circle" width="35" height="35" alt="User">
                <span class="fw-semibold">{{ Auth::user()->name }}</span>
              </a>
              <ul class="dropdown-menu dropdown-menu-end shadow rounded-3 border-0 mt-2" aria-labelledby="userDropdown">
                <li><a class="dropdown-item" href="{{ route('bookings.riwayat') }}"><i class="ti ti-clock-history me-2"></i>Riwayat</a></li>
                <li><hr class="dropdown-divider"></li>
                <li>
                  <a class="dropdown-item text-danger" href="{{ route('logout') }}"
                     onclick="event.preventDefault(); document.getElementById('logout-form').submit();">
                    <i class="ti ti-logout me-2"></i>Logout
                  </a>
                  <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
                    @csrf
                  </form>
                </li>
              </ul>
            </li>
          @endguest
        </ul>
      </div>
    </div>
  </nav>
</header>
