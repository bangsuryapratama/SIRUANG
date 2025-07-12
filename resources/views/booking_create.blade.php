@extends('layouts.frontend')

@section('content')
<div class="container py-5">
    <div class="row justify-content-center">
        <div class="col-lg-8">
            <div class="card shadow-sm border-0 rounded-4">
                <div class="card-body p-5">
                    <h3 class="text-center text-primary fw-bold mb-4">
                        <i class="bi bi-calendar-check-fill me-2"></i>Booking Ruangan
                    </h3>
                    @if (session('error'))
                        <div class="alert alert-danger">{{ session('error') }}</div>
                    @endif
                    @if (session('success'))
                        <div class="alert alert-success">{{ session('success') }}</div>
                    @endif
                    <form action="{{ route('bookings.store') }}" method="POST" novalidate>
                        @csrf
                        <input type="hidden" name="user_id" value="{{ auth()->id() }}">

                        <div class="mb-3">
                            <label class="form-label fw-semibold">Pilih Ruangan</label>
                            <select name="ruang_id" class="form-select @error('ruang_id') is-invalid @enderror" required>
                                <option value="">-- Pilih Ruangan --</option>
                                @foreach ($ruangans as $ruangan)
                                   <option value="{{ $ruangan->id }}"
                                        {{ request('ruangan_id') == $ruangan->id || old('ruang_id') == $ruangan->id ? 'selected' : '' }}>
                                        {{ $ruangan->nama }}
                                    </option>
                                @endforeach
                            </select>
                            @error('ruang_id')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="mb-3">
                            <label class="form-label fw-semibold">Tanggal</label>
                            <input type="date" name="tanggal" id="tanggal"
                                class="form-control @error('tanggal') is-invalid @enderror"
                                value="{{ old('tanggal') }}" required>
                            @error('tanggal')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="row g-3">
                            <div class="col-md-6">
                                <label class="form-label fw-semibold">Jam Mulai</label>
                                <input type="time" name="jam_mulai" id="jam_mulai"
                                    class="form-control @error('jam_mulai') is-invalid @enderror"
                                    value="{{ old('jam_mulai') }}" required>
                                @error('jam_mulai')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>
                            <div class="col-md-6">
                                <label class="form-label fw-semibold">Jam Selesai</label>
                                <input type="time" name="jam_selesai" id="jam_selesai"
                                    class="form-control @error('jam_selesai') is-invalid @enderror"
                                    value="{{ old('jam_selesai') }}" required>
                                @error('jam_selesai')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>
                        </div>

                        <div class="d-grid mt-4">
                            <button type="submit" class="btn btn-primary btn-lg rounded-pill">
                                <i class="bi bi-send-check me-2"></i> Ajukan Booking
                            </button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
