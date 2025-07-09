@extends('layouts.backend')

@section('content')
<div class="container-fluid">
    <div class="card shadow-sm">
        <div class="card-header">
            <h4>Detail Jadwal</h4>
        </div>
        <div class="card-body">
           <div class="mb-3">
            <p><strong>Ruangan:</strong> {{ $jadwal->ruangan->nama }}</p>
            <p><strong>Tanggal:</strong> {{ $jadwal->tanggal_format }}</p>
            <p><strong>Jam Mulai:</strong> {{ $jadwal->jam_mulai }}</p>
            <p><strong>Jam Selesai:</strong> {{ $jadwal->jam_selesai }}</p>
            <p><strong>Keterangan:</strong>{{ $jadwal->ket }}</p>
            <a href="{{ route('backend.jadwal.index') }}" class="btn btn-secondary">Kembali</a>
        </div>
    </div>
</div>
@endsection
