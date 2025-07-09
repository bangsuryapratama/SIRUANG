@extends('layouts.backend')

@section('content')
<div class="container-fluid">
    <div class="card shadow-sm">
        <div class="card-header bg text-white">
            <h5 class="mb-0">Edit Jadwal</h5>
        </div>
        <div class="card-body">
            <form action="{{ route('backend.jadwal.update', $jadwal->id) }}" method="POST">
                @csrf
                @method('PUT')

                <div class="mb-3">
                    <label class="form-label">Ruangan</label>
                    <select name="ruang_id" class="form-control" required>
                        <option value="">Pilih Ruangan</option>
                        @foreach($ruangans as $ruangan)
                            <option value="{{ $ruangan->id }}" {{ $ruangan->id == $jadwal->ruang_id ? 'selected' : '' }}>
                                {{ $ruangan->nama }}
                            </option>
                        @endforeach
                    </select>
                </div>

                <div class="mb-3">
                    <label class="form-label">Tanggal</label>
                    <input type="date" name="tanggal" class="form-control" value="{{ $jadwal->tanggal }}" required>
                </div>

                <div class="mb-3">
                    <label class="form-label">Jam Mulai</label>
                    <input type="time" name="jam_mulai" class="form-control" value="{{ $jadwal->jam_mulai }}" required>
                </div>

                <div class="mb-3">
                    <label class="form-label">Jam Selesai</label>
                    <input type="time" name="jam_selesai" class="form-control" value="{{ $jadwal->jam_selesai }}" required>
                </div>

                <div class="mb-3">
                    <label class="form-label">Keterangan</label>
                    <input type="text" name="ket" class="form-control" value="{{ $jadwal->ket }}" required>
                </div>

                <div class="d-flex justify-content-end">
                    <a href="{{ route('backend.jadwal.index') }}" class="btn btn-secondary me-2">Cancel</a>
                    <button type="submit" class="btn btn-warning text-white">Update</button>
                </div>

            </form>
        </div>
    </div>
</div>
@endsection
