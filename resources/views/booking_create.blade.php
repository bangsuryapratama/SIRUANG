@extends('layouts.frontend')

@section('content')
<div class="container py-5">
    <h2 class="mb-4">Form Booking Ruangan</h2>

    @if (session('error'))
        <div class="alert alert-danger">{{ session('error') }}</div>
    @endif

    <form action="{{ route('bookings.store') }}" method="POST">
        @csrf

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
            <input type="date" name="tanggal" id="tanggal" class="form-control" required>
        </div>

        <div class="mb-3">
            <label>Jam Mulai</label>
            <input type="time" name="jam_mulai" id="jam_mulai" class="form-control" required>
        </div>

        <div class="mb-3">
            <label>Jam Selesai</label>
            <input type="time" name="jam_selesai" id="jam_selesai" class="form-control" required>
        </div>

        <button class="btn btn-primary" type="submit">Ajukan Booking</button>
    </form>
</div>
@endsection

@push('styles')
<style>
    .is-invalid {
        border-color: red;
    }
</style>
@endpush

@push('scripts')
<script>
    document.addEventListener('DOMContentLoaded', function () {
        const tanggalInput = document.getElementById('tanggal');
        const jamMulaiInput = document.getElementById('jam_mulai');
        const jamSelesaiInput = document.getElementById('jam_selesai');

        function pad(n) {
            return n < 10 ? '0' + n : n;
        }

        function getCurrentTime() {
            const now = new Date();
            return pad(now.getHours()) + ':' + pad(now.getMinutes());
        }

        tanggalInput.addEventListener('change', function () {
            const selectedDate = new Date(this.value);
            const today = new Date();

            // Reset
            jamMulaiInput.classList.remove('is-invalid');
            jamSelesaiInput.classList.remove('is-invalid');

            if (selectedDate.toDateString() === today.toDateString()) {
                const currentTime = getCurrentTime();

                // Set batas minimal
                jamMulaiInput.setAttribute('min', currentTime);
                jamSelesaiInput.setAttribute('min', currentTime);

                jamMulaiInput.addEventListener('input', () => {
                    jamMulaiInput.classList.toggle('is-invalid', jamMulaiInput.value < currentTime);
                });

                jamSelesaiInput.addEventListener('input', () => {
                    jamSelesaiInput.classList.toggle('is-invalid', jamSelesaiInput.value < currentTime);
                });

            } else {
                jamMulaiInput.removeAttribute('min');
                jamSelesaiInput.removeAttribute('min');
                jamMulaiInput.classList.remove('is-invalid');
                jamSelesaiInput.classList.remove('is-invalid');
            }
        });
    });
</script>
@endpush
