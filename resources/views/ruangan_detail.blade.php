@extends('layouts.frontend')

@section('content')
<div class="container py-5">
    <div class="row justify-content-center">
        <div class="col-md-10">
            <div class="card border-0 shadow-sm rounded-3 overflow-hidden">
                <div class="row g-0">
                    <div class="col-md-6">
                        @if($ruangan->cover)
                        <img src="{{ asset('storage/'.$ruangan->cover) }}" 
                             class="w-100 h-100 object-fit-cover" 
                             alt="Ruangan {{ $ruangan->nama }}">
                        @else
                        <div class="w-100 h-100 bg-light d-flex align-items-center justify-content-center">
                            <div class="text-center text-muted p-4">
                                <i class="bi bi-image" style="font-size: 3rem"></i>
                                <p class="mt-2">Tidak ada gambar</p>
                            </div>
                        </div>
                        @endif
                    </div>
                
                    <div class="col-md-6">
                        <div class="card-body p-4 p-lg-5">
                            <h1 class="card-title mb-4">{{ $ruangan->nama }}</h1>
                            
                            <div class="d-flex align-items-center mb-4">
                                <div class="me-3">
                                    <div class="bg-light rounded-3 p-3 text-center">
                                        <div class="text-muted small">Kapasitas</div>
                                        <div class="fw-bold">{{ $ruangan->kapasitas }}</div>
                                    </div>
                                </div>
                            </div>
                            
                            <div class="mb-4">
                                <h5 class="mb-3">Fasilitas</h5>
                                <div class="row g-2">
                                    @foreach(explode(',', $ruangan->fasilitas) as $item)
                                    <div class="col-12">
                                        <div class="p-2 border-start border-primary border-3 ps-3">
                                            <span class="text-primary me-2">•</span>
                                            {{ trim($item) }}
                                        </div>
                                    </div>
                                    @endforeach
                                </div>
                            </div>

                            <div class="d-grid mt-4">
                                <a href="{{ route('bookings.create') }}" 
                                   class="btn btn-primary btn-lg rounded-3 fw-semibold py-3">
                                    Booking Sekarang
                                </a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection