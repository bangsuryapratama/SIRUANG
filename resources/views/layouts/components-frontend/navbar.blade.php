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
           <a class="nav-link fs-5 fw-semibold text-dark" href="{{ route('bookings.create') }}">Booking</a>
          </li>
          <li class="nav-item">
            <a class="nav-link fs-5 fw-semibold text-dark" href="">Ruangan</a>
          </li>
          @auth
          <li class="nav-item">
            <a class="nav-link fs-5 fw-semibold text-dark" href="">Riwayat</a>
          </li>
          @endauth
        </ul>

        <!-- Login Button -->
        <div>
          <ul class="navbar-nav ms-auto">
                        <!-- Authentication Links -->
                        @guest
                            @if (Route::has('login'))
                                <li class="nav-item">
                                    <a class="nav-link" href="{{ route('login') }}">{{ __('Login') }}</a>
                                </li>
                            @endif
                        @else
                            <li class="nav-item dropdown">
                                <a id="navbarDropdown" class="nav-link dropdown-toggle" href="#" role="button" data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false" v-pre>
                                    {{ Auth::user()->name }}
                                </a>

                                <div class="dropdown-menu dropdown-menu-end" aria-labelledby="navbarDropdown">
                                    <a class="dropdown-item" href="{{ route('logout') }}"
                                       onclick="event.preventDefault();
                                                     document.getElementById('logout-form').submit();">
                                        {{ __('Logout') }}
                                    </a>

                                    <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
                                        @csrf
                                    </form>
                                </div>
                            </li>
                        @endguest
                    </ul>
        </div>
      </div>
    </div>
  </nav>
</header>
