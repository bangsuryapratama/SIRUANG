@extends('layouts.frontend')

@section('content')
<div class="container-fluid mt-5">
    <div class="card shadow-sm">
        <div class="card-header bg-success text-white">
            <h5 class="mb-0">Detail Booking</h5>
        </div>

        <div class="card-body">
            <div class="mb-3">
                <label class="form-label fw-bold">Nama</label>
                <p class="form-control-plaintext">{{ auth()->user()->name }}</p>
            </div>

            <div class="mb-3">
                <label class="form-label fw-bold">Ruangan</label>
                <p class="form-control-plaintext">{{ $booking->ruangan->nama }}</p>
            </div>

            <div class="mb-3">
                <label class="form-label fw-bold">Tanggal</label>
                <p class="form-control-plaintext">{{ \Carbon\Carbon::parse($booking->tanggal)->translatedFormat('l, j F Y') }}</p>
            </div>

            <div class="mb-3">
                <label class="form-label fw-bold">Jam</label>
                <p class="form-control-plaintext">{{ $booking->jam_mulai }} - {{ $booking->jam_selesai }}</p>
            </div>

            <div class="mb-3">
                <label class="form-label fw-bold">Status</label>
                <span class="badge 
                    @if($booking->status === 'Diterima') bg-success 
                    @elseif($booking->status === 'Ditolak') bg-danger 
                    @else bg-warning text-dark 
                    @endif">
                    {{ $booking->status }}
                </span>
            </div>

            <div class="d-flex justify-content-end">
                <a href="{{ route('bookings.create') }}" class="btn btn-primary">Buat Booking Baru</a>
            </div>
        </div>
    </div>
</div>
@endsection
