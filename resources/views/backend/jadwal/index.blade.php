@extends('layouts.backend')

@section('styles')
<link rel="stylesheet" href="https://cdn.datatables.net/2.3.2/css/dataTables.bootstrap5.css">
@endsection

@section('content')
<div class="container-fluid">
    <div class="card shadow-sm">
        <div class="card-header d-flex justify-content-between align-items-center">
            <h4 class="mb-0">Jadwal</h4>
            <a href="{{ route('backend.jadwal.create') }}" class="btn btn-sm btn-outline-primary">Add jadwal</a>
        </div>
        <div class="card-body">
            <div class="table-responsive">
                <table class="table table-bordered table-striped" id="jadwalTable">
                    <thead>
                        <tr>
                            <th>No</th>
                            <th>Ruangan</th>
                            <th>Tanggal</th>
                            <th>Jam Mulai</th>
                            <th>Jam Selesai</th>
                            <th>Keterangan</th>
                            <th>Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($jadwals as $jadwal)
                        <tr>
                            <td>{{ $loop->iteration }}</td>
                            <td>{{ $jadwal->ruangan->nama}}</td>
                            <td width="100">{{ $jadwal->tanggal_format }}</td>
                            <td>{{ $jadwal->jam_mulai }}</td>
                            <td>{{ $jadwal->jam_selesai }}</td>
                            <td>{{ $jadwal->ket }}</td>
                            <td width="120">
                                <a href="{{ route('backend.jadwal.show', $jadwal->id) }}" class="btn btn-sm btn-info">View</a>
                                <a href="{{ route('backend.jadwal.edit', $jadwal->id) }}" class="btn btn-sm btn-warning">Edit</a>
                                <form action="{{ route('backend.jadwal.destroy', $jadwal->id) }}" method="POST" class="d-inline">
                                    @csrf
                                    @method('DELETE')
                                    <button class="btn btn-sm btn-danger" onclick="return confirm('Delete this room?')">Delete</button>
                                </form>
                            </td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>
@endsection

@push('scripts')
<script src="https://cdn.datatables.net/2.3.2/js/dataTables.js"></script>
<script src="https://cdn.datatables.net/2.3.2/js/dataTables.bootstrap5.js"></script>
<script>
    $(document).ready(function () {
        $('#jadwalTable').DataTable();
    });
</script>
@endpush
