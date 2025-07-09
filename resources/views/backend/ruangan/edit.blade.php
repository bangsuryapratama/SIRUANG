@extends('layouts.backend')

@section('content')
<div class="container-fluid">
    <div class="card shadow-sm">
        <div class="card-header">
            <h4>Edit Ruangan</h4>
        </div>
        <div class="card-body">
            <form action="{{ route('backend.ruangan.update', $ruangan->id) }}" method="POST" enctype="multipart/form-data">
                @csrf
                @method('PUT')

                <div class="mb-3">
                    <label for="nama" class="form-label">Nama Ruangan</label>
                    <input type="text" name="nama" id="nama" class="form-control" value="{{ $ruangan->nama }}" required>
                </div>

                <div class="mb-3">
                    <label for="kapasitas" class="form-label">Kapasitas</label>
                    <input type="text" name="kapasitas" id="kapasitas" class="form-control" value="{{ $ruangan->kapasitas }}" required>
                </div>

                <div class="mb-3">
                    <label for="fasilitas" class="form-label">Fasilitas</label>
                    <textarea name="fasilitas" id="fasilitas" class="form-control" rows="4" required>{{ $ruangan->fasilitas }}</textarea>
                </div>

                <div class="mb-3">
                    <label for="cover" class="form-label">Ganti Cover (opsional)</label>
                    <input type="file" name="cover" id="cover" class="form-control">
                    @if($ruangan->cover)
                        <small class="d-block mt-2">Cover saat ini:</small>
                        <img src="{{ asset('storage/' . $ruangan->cover) }}" alt="Current Cover" width="120">
                    @endif
                </div>

                <button type="submit" class="btn btn-primary">Update</button>
                <a href="{{ route('backend.ruangan.index') }}" class="btn btn-secondary">Batal</a>
            </form>
        </div>
    </div>
</div>
@endsection
