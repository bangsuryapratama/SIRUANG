<footer class=" bg-dark text-light text-white mt-5 pt-5 pb-3">
  <div class="container">
    <div class="row mb-4">
      <div class="col-md-4">
        <h5 class="fw-bold mb-3  text-white">Tentang SIRUANG</h5>
        <p class="text-muted  text-white">
          SIRUANG adalah sistem penjadwalan ruangan kelas dan laboratorium secara digital. Didesain agar bebas bentrok dan efisien digunakan oleh seluruh civitas akademika.
        </p>
      </div>

      <div class="col-md-4">
        <h5 class="fw-bold mb-3  text-white">Navigasi</h5>
        <ul class="list-unstyled text-muted">
          <li><a href="{{ route('bookings.create') }}" class="text-white text-decoration-none">Booking Ruangan</a></li>
          <li><a href="{{ route('ruangan') }}" class="text-white text-decoration-none">Daftar Ruangan</a></li>
          <li><a href="{{ route('login') }}" class="text-white text-decoration-none">Login Admin</a></li>
        </ul>
      </div>

      <div class="col-md-4">
        <h5 class="fw-bold mb-3  text-white">Ikuti Kami</h5>
        <div class="d-flex gap-3">
          <a href="#" class="text-white fs-5" data-bs-toggle="tooltip" data-bs-title="Facebook">
            <i class="bi bi-facebook"></i>
          </a>
          <a href="#" class="text-white fs-5" data-bs-toggle="tooltip" data-bs-title="Twitter">
            <i class="bi bi-twitter"></i>
          </a>
          <a href="#" class="text-white fs-5" data-bs-toggle="tooltip" data-bs-title="Instagram">
            <i class="bi bi-instagram"></i>
          </a>
        </div>
      </div>
    </div>

    <hr class="border-light">

    <div class="d-flex flex-column flex-md-row justify-content-between align-items-center text-muted">
      <div>
        <small>&copy; {{ date('Y') }} SIRUANG. All rights reserved.</small>
      </div>
      <div>
        <small>Dibuat Oleh Surya Pratama and TEAM</small>
      </div>
    </div>
  </div>
</footer>
