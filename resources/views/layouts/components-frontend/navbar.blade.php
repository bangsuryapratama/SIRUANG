<header class="shadow-sm">
  <nav class="navbar navbar-expand-lg bg-white py-3">
    <div class="container">
      <!-- Logo -->
      <a class="navbar-brand d-flex align-items-center gap-2" href="{{ url('/') }}">
        <img src="{{ asset('assets/backend/img/logo.png') }}" alt="Logo" height="45">
      </a>

      <!-- Toggle Button -->
      <button class="navbar-toggler border-0" type="button" data-bs-toggle="collapse" data-bs-target="#navbarContent">
        <i class="ti ti-menu-2 fs-4 text-dark"></i>
      </button>

      <!-- Navbar Content -->
      <div class="collapse navbar-collapse" id="navbarContent">
        <!-- Menu Tengah -->
        <ul class="navbar-nav mx-auto gap-lg-4">
          <li class="nav-item"><a class="nav-link text-dark fw-semibold" href="{{ url('/') }}">Beranda</a></li>
          <li class="nav-item"><a class="nav-link text-dark fw-semibold" href="{{ route('bookings.create') }}">Booking</a></li>
          <li class="nav-item"><a class="nav-link text-dark fw-semibold" href="{{ route('ruangan') }}">Ruangan</a></li>
          @auth
            <li class="nav-item"><a class="nav-link text-dark fw-semibold" href="{{ route('bookings.riwayat') }}">Riwayat</a></li>
          @endauth
            
        </ul>

        <!-- Kanan -->
        <ul class="navbar-nav ms-auto">
          @guest
            <li class="nav-item">
              <a href="{{ route('login') }}" class="btn btn-outline-primary rounded-pill px-4 fw-semibold">Login</a>
            </li>
          @else
            <!-- Notifikasi -->
            <li class="nav-item dropdown me-3">
              <a class="nav-link position-relative" href="#" id="notifDropdown" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                <i class="bi bi-bell-fill fs-5 text-dark"></i>
                @if(isset($userNotifications) && $userNotifications->count())
                  <span class="position-absolute top-0 start-100 translate-middle badge rounded-pill bg-danger">
                    {{ $userNotifications->count() }}
                  </span>
                @endif
              </a>
              <ul class="dropdown-menu dropdown-menu-end shadow-sm border-0 mt-2 rounded-4" aria-labelledby="notifDropdown" style="min-width: 280px;">
                <li class="dropdown-header fw-semibold px-3 pt-2">Notifikasi Booking</li>
                @forelse ($userNotifications as $notif)
                  <li>
                    <a class="dropdown-item small py-2 px-3" href="{{ route('bookings.riwayat') }}">
                      @if ($notif->status == 'Diterima')
                        ✅ Booking untuk <strong>{{ $notif->ruangan->nama }}</strong> telah <span class="text-success">DITERIMA</span>.
                      @elseif ($notif->status == 'Ditolak')
                        ❌ Booking untuk <strong>{{ $notif->ruangan->nama }}</strong> <span class="text-danger">DITOLAK</span>.
                      @endif
                      <div class="text-muted small">{{ $notif->created_at->diffForHumans() }}</div>
                    </a>
                  </li>
                @empty
                  <li><span class="dropdown-item text-muted small">Tidak ada notifikasi.</span></li>
                @endforelse
                <li><hr class="dropdown-divider"></li>
                <li>
                  <a class="dropdown-item text-center text-primary small fw-semibold" href="{{ route('bookings.riwayat') }}">
                    <i class="bi bi-eye me-1"></i> Lihat Semua Booking
                  </a>
                </li>
              </ul>
            </li>

            <!-- User Dropdown -->
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

<!-- Script agar notif langsung hilang saat diklik -->
<script>
document.addEventListener('DOMContentLoaded', function () {
  const notifBtn = document.getElementById('notifDropdown');
  notifBtn?.addEventListener('click', function () {
    fetch("{{ url('/notifications/read') }}", {
      method: "POST",
      headers: {
        "X-CSRF-TOKEN": "{{ csrf_token() }}",
        "Accept": "application/json",
        "Content-Type": "application/json"
      }
    }).then(() => {
      const badge = notifBtn.querySelector('.badge');
      if (badge) badge.remove(); // Hapus badge merah
    });
  });
});
</script>
