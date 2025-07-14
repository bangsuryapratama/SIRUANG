@extends('layouts.frontend')

@section('content')
<div class="container py-5">
  <div class="text-center mb-5">
    <h1 class="display-4 fw-bold text-gradient">Daftar Ruangan</h1>
    <p class="lead text-muted">Pilih ruangan sesuai kebutuhanmu. Booking cepat, tanpa bentrok jadwal.</p>
  </div>

  <div class="row g-4">
    @foreach($ruangans as $ruangan)
    <div class="col-lg-4 col-md-6">
      <div class="card room-card h-100 border-0 rounded-5 overflow-hidden hover-scale transition-all">
        @if($ruangan->cover)
        <div class="ratio ratio-16x9">
          <img src="{{ asset('storage/'.$ruangan->cover) }}" class="object-fit-cover w-100 h-100" alt="{{ $ruangan->nama }}">
        </div>
        @endif

        <div class="card-body p-4">
          <h5 class="fw-bold text-body mb-1">{{ $ruangan->nama }}</h5>
          <p class="text-muted small mb-3">
            <i class="bi bi-people-fill me-1"></i> Kapasitas: {{ $ruangan->kapasitas }} orang
          </p>

          <div class="mb-3">
            <div class="d-flex flex-wrap gap-2">
              @foreach(explode(',', $ruangan->fasilitas) as $fasilitas)
              <span class="badge bg-light text-dark border rounded-pill px-3 py-1 small d-flex align-items-center shadow-sm">
                <i class="bi bi-check-circle-fill text-success me-1"></i> {{ trim($fasilitas) }}
              </span>
              @endforeach
            </div>
          </div>

          <hr class="text-muted my-3" style="opacity: 0.1;">
        </div>

        <div class="card-footer bg-transparent border-0 text-center pb-4">
          <a href="{{ route('ruangan.detail', $ruangan->id) }}" class="btn btn-gradient rounded-pill w-100 py-2 shadow-sm fw-semibold">
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
  /* Gradient Text Title */
  .text-gradient {
    background: linear-gradient(to right, #0d1b2a, #415a77);
    -webkit-background-clip: text;
    -webkit-text-fill-color: transparent;
  }

  /* Card Styling */
  .room-card {
    background: rgba(255, 255, 255, 0.9);
    backdrop-filter: blur(8px);
    border: 1px solid rgba(255, 255, 255, 0.2);
    transition: all 0.3s ease-in-out;
  }

  .hover-scale:hover {
    transform: scale(1.015);
    box-shadow: 0 1.2rem 2rem rgba(0, 0, 0, 0.1) !important;
  }

  .object-fit-cover {
    object-fit: cover;
  }

  /* Gradient Button */
  .btn-gradient {
    background: linear-gradient(to right, #1b263b, #778da9);
    color: white;
    border: none;
    transition: all 0.3s ease-in-out;
  }

  .btn-gradient:hover {
    background: linear-gradient(to right, #0d1b2a, #62778e);
    transform: translateY(-2px);
  }

  /* Badge Style */
  .badge.bg-light {
    background-color: #f5f7fa !important;
    border-color: #dee2e6 !important;
    transition: all 0.2s ease-in-out;
  }

  .badge:hover {
    background-color: #e2e8f0 !important;
    transform: scale(1.05);
  }
</style>
@endpush
