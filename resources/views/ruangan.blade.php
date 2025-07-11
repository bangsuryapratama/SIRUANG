@extends('layouts.frontend')

@section('content')
<div class="container py-5">
    <div class="text-center mb-5">
        <h1 class="display-5 fw-bold text-primary">Daftar Ruangan</h1>
        <p class="lead">Temukan ruangan yang sesuai dengan kebutuhan acara Anda</p>
    </div>

    <div class="row g-4">
        @foreach($ruangans as $ruangan)
        <div class="col-lg-4 col-md-6">
            <div class="card h-100 border-0 shadow-sm transition-all duration-300 hover-shadow-lg hover-transform-up">
                @if($ruangan->cover)
                <div class="ratio ratio-16x9">
                    <img src="{{ asset('storage/'.$ruangan->cover) }}" class="card-img-top object-fit-cover" alt="Ruangan {{ $ruangan->nama }}">
                </div>
                @endif
                
                <div class="card-body">
                    <div class="d-flex justify-content-between align-items-start mb-2">
                        <h3 class="h5 card-title fw-bold mb-0">{{ $ruangan->nama }}</h3>
                        <span class="badge bg-primary rounded-pill">Kapasitas: {{ $ruangan->kapasitas }}</span>
                    </div>
                    
                    <div class="mb-3">
                        <h6 class="text-uppercase text-muted small mb-2">Fasilitas</h6>
                        <div class="d-flex flex-wrap gap-2">
                            @foreach(explode(',', $ruangan->fasilitas) as $fasilitas)
                            <span class="badge bg-light text-dark border">
                                <i class="bi bi-check-circle-fill text-success me-1"></i>
                                {{ trim($fasilitas) }}
                            </span>
                            @endforeach
                        </div>
                    </div>
                </div>
                
                <div class="card-footer bg-transparent border-top-0 pt-0 pb-3">
                    <a href="{{ route('ruangan.detail', $ruangan->id) }}" class="btn btn-primary w-100">
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
    .hover-shadow-lg:hover {
        box-shadow: 0 1rem 3rem rgba(0,0,0,.175) !important;
    }
    .hover-transform-up:hover {
        transform: translateY(-5px);
    }
    .transition-all {
        transition: all 0.25s ease;
    }
</style>
@endpush