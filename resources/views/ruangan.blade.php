@extends('layouts.frontend')

@section('content')
<div class="container py-5">
  <div class="text-center mb-5">
    <h1 class="display-5 fw-bold text-dark">Daftar Ruangan</h1>
    <p class="lead text-muted">Pilih ruangan sesuai kebutuhanmu. Booking cepat, tanpa bentrok.</p>
  </div>

  <div class="row g-4">
    @foreach($ruangans as $ruangan)
    <div class="col-lg-4 col-md-6">
      <div class="card h-100 border border-light-subtle shadow-sm rounded-4 overflow-hidden transition-all hover-up">
        @if($ruangan->cover)
        <div class="ratio ratio-16x9">
          <img src="{{ asset('storage/'.$ruangan->cover) }}" class="object-fit-cover w-100 h-100" alt="{{ $ruangan->nama }}">
        </div>
        @endif

        <div class="card-body">
          <h5 class="fw-bold text-dark mb-1">{{ $ruangan->nama }}</h5>
          <p class="text-muted small mb-2"><i class="bi bi-people-fill me-1"></i> {{ $ruangan->kapasitas }}</p>

          <div class="mb-2">
            <div class="d-flex flex-wrap gap-2">
              @foreach(explode(',', $ruangan->fasilitas) as $fasilitas)
              <span class="badge bg-light border text-dark rounded-pill px-3 py-1 small d-flex align-items-center">
                <i class="bi bi-check-circle-fill text-success me-1"></i> {{ trim($fasilitas) }}
              </span>
              @endforeach
            </div>
          </div>
        </div>

        <div class="card-footer bg-white border-0 text-center pb-4">
          <a href="{{ route('ruangan.detail', $ruangan->id) }}" class="btn btn-dark rounded-pill px-4 w-100 shadow-sm">
            <i class="bi bi-eye-fill me-1"></i> Lihat Detail
          </a>
        </div>
      </div>
    </div>
    @endforeach
  </div>
</div>
@endsection

@push('styles')
<style>
  .hover-up {
    transition: all 0.3s ease-in-out;
  }

  .hover-up:hover {
    transform: translateY(-6px);
    box-shadow: 0 1rem 2rem rgba(0, 0, 0, 0.15) !important;
  }

  .object-fit-cover {
    object-fit: cover;
  }
</style>
@endpush
