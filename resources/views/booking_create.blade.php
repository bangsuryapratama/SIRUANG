@extends('layouts.frontend')

@section('content')
<div class="container py-5">
    <h2 class="mb-4">Form Booking Ruangan</h2>
    <form action="{{ route('bookings.store') }}" method="POST">
        @csrf

        <div class="mb-3">
            <label>Nama</label>
            <input type="text" class="form-control" value="{{ auth()->user()->name }}" readonly>
        </div>

        <input type="hidden" name="user_id" value="{{ auth()->id() }}">

        <div class="mb-3">
            <label>Ruangan</label>
            <select name="ruang_id" class="form-select" required>
                <option value="">-- Pilih Ruangan --</option>
                @foreach ($ruangans as $ruangan)
                    <option value="{{ $ruangan->id }}">{{ $ruangan->nama }}</option>
                @endforeach
            </select>
        </div>

        <div class="mb-3">
            <label>Tanggal</label>
            <input type="date" name="tanggal" class="form-control" required>
        </div>

        <div class="mb-3">
            <label>Jam Mulai</label>
            <input type="time" name="jam_mulai" class="form-control" required>
        </div>

        <div class="mb-3">
            <label>Jam Selesai</label>
            <input type="time" name="jam_selesai" class="form-control" required>
        </div>

        <button class="btn btn-primary" type="submit">Ajukan Booking</button>
    </form>
</div>
@endsection
