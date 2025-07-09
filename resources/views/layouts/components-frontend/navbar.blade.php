<header class="header-fp p-0 w-100">
  <nav class="navbar navbar-expand-lg bg-primary-subtle py-3">
    <div class="container d-flex align-items-center justify-content-between">
      <!-- Logo -->
      <a href="{{ url('/') }}" class="text-nowrap logo-img">
        <img src="{{ asset('assets/backend/img/logo.png') }}" alt="Logo" class="dark-logo" style="height: 50px;">
      </a>

      <!-- Toggle Button (for mobile) -->
      <button class="navbar-toggler border-0 shadow-none" type="button" data-bs-toggle="collapse" data-bs-target="#navbarContent" aria-controls="navbarContent" aria-expanded="false">
        <i class="ti ti-menu-2 fs-4"></i>
      </button>

      <!-- Navbar Content -->
      <div class="collapse navbar-collapse" id="navbarContent">
        <ul class="navbar-nav mx-auto mb-2 mb-lg-0 gap-lg-5">
          <li class="nav-item">
            <a class="nav-link fs-5 fw-semibold text-dark" href="{{ url('/') }}">Beranda</a>
          </li>
          <li class="nav-item">
            <a class="nav-link fs-5 fw-semibold text-dark" href="">Booking</a>
          </li>
          <li class="nav-item">
            <a class="nav-link fs-5 fw-semibold text-dark" href="">Ruangan</a>
          </li>
          <li class="nav-item">
            <a class="nav-link fs-5 fw-semibold text-dark" href="">Riwayat</a>
          </li>
        </ul>

        <!-- Login Button -->
        <div>
          @auth
            <a href="" class="btn btn-outline-primary px-4 py-2">Dashboard</a>
          @else
            <a href="{{ route('login') }}" class="btn btn-primary px-4 py-2">Log In</a>
          @endauth
        </div>
      </div>
    </div>
  </nav>
</header>
