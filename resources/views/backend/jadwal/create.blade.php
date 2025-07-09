@extends('layouts.backend')

@section('content')
<div class="container-fluid">
    <div class="card shadow-sm">
        <div class="card-header bg-primary text-white">
            <h5 class="mb-0">Add New Jadwal</h5>
        </div>
        <div class="card-body">
            <form action="{{ route('backend.jadwal.store') }}" method="POST" enctype="multipart/form-data">
                @csrf

                <div class="mb-3">
                    <label class="form-label">Ruangan</label>
                    <select name="ruang_id" class="form-control" required>
                        <option value="">Pilih Ruangan</option>
                        @foreach($ruangans as $ruangan)
                            <option value="{{ $ruangan->id }}">{{ $ruangan->nama }}</option>
                        @endforeach
                    </select>
                </div>

                <div class="mb-3">
                    <label class="form-label">Tanggal</label>
                    <input type="date" name="tanggal" class="form-control" required>
                </div>

                <div class="mb-3">
                    <label class="form-label">Jam Mulai</label>
                    <input type="time" name="jam_mulai" class="form-control" required>
                </div>

                 <div class="mb-3">
                    <label class="form-label">Jam Selesai</label>
                    <input type="time" name="jam_selesai" class="form-control" required>
                </div>

                <div class="mb-3">
                    <label class="form-label">Keterangan</label>
                    <input type="text" name="ket" class="form-control" required>
                </div>

                <div class="d-flex justify-content-end">
                    <a href="{{ route('backend.jadwal.index') }}" class="btn btn-secondary me-2">Cancel</a>
                    <button type="submit" class="btn btn-primary">Save</button>
                </div>

            </form>
        </div>
    </div>
</div>
@endsection
