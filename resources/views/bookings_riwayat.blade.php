@extends('layouts.frontend')

@section('content')
<div class="container py-5">
    <h2 class="mb-4 fw-bold text-center text-primary">
        <i class="bi bi-clock-history me-2"></i>Riwayat Booking Anda
    </h2>

    @if($booking->count())
        <div class="d-flex justify-content-end mb-3">
            <a href="{{ route('bookings.export') }}" class="btn btn-danger rounded-pill shadow-sm">
                <i class="bi bi-file-earmark-pdf-fill me-1"></i> Export PDF
            </a>
        </div>

        <div class="table-responsive shadow rounded-4">
            <table class="table table-hover align-middle text-center mb-0">
                <thead class="table-light">
                    <tr class="fw-semibold text-uppercase small text-secondary">
                        <th>#</th>
                        <th>Ruangan</th>
                        <th>Tanggal</th>
                        <th>Waktu</th>
                        <th>Status</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($booking as $index => $data)
                        <tr>
                            <td class="text-muted">{{ $index + 1 }}</td>
                            <td class="fw-medium">{{ $data->ruangan->nama }}</td>
                            <td>{{ \Carbon\Carbon::parse($data->tanggal)->translatedFormat('l, d F Y') }}</td>
                            <td>{{ $data->jam_mulai }} - {{ $data->jam_selesai }}</td>
                            <td>
                                @switch($data->status)
                                    @case('Pending')
                                        <span class="badge bg-warning text-dark px-3 py-2">Menunggu</span>
                                        @break
                                    @case('Disetujui')
                                        <span class="badge bg-primary px-3 py-2">Disetujui</span>
                                        @break
                                    @case('Ditolak')
                                        <span class="badge bg-danger px-3 py-2">Ditolak</span>
                                        @break
                                    @case('Selesai')
                                        <span class="badge bg-success px-3 py-2">Selesai</span>
                                        @break
                                    @default
                                        <span class="badge bg-secondary px-3 py-2">Tidak Diketahui</span>
                                @endswitch
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    @else
        <div class="alert alert-info text-center mt-4">
            <i class="bi bi-info-circle-fill me-2"></i> Belum ada riwayat booking ruangan.
        </div>
    @endif
</div>
@endsection
