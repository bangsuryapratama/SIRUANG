@extends('layouts.backend')

@section('content')
<div class="container-fluid">
    <div class="card shadow-sm">
        <div class="card-header">
            <h4>Detail Ruangan</h4>
        </div>
        <div class="card-body">
            <div class="mb-3">
                <img src="{{ asset('storage/' . $ruangan->cover) }}" alt="Cover" width="200">
            </div>
            <p><strong>Nama:</strong> {{ $ruangan->nama }}</p>
            <p><strong>Kapasitas:</strong> {{ $ruangan->kapasitas }}</p>
            <p><strong>Fasilitas:</strong> {{ $ruangan->fasilitas }}</p>
            <a href="{{ route('backend.ruangan.index') }}" class="btn btn-secondary">Kembali</a>
        </div>
    </div>
</div>
@endsection
