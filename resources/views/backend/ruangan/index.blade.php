@extends('layouts.backend')

@section('styles')
<link rel="stylesheet" href="https://cdn.datatables.net/2.3.2/css/dataTables.bootstrap5.css">
@endsection

@section('content')
<div class="container-fluid">
    <div class="card shadow-sm">
        <div class="card-header d-flex justify-content-between align-items-center">
            <h4 class="mb-0">Data Ruangan</h4>
            <a href="{{ route('backend.ruangan.create') }}" class="btn btn-sm btn-outline-primary">Add Ruangan</a>
        </div>
        <div class="card-body">
            <div class="table-responsive">
                <table class="table table-bordered table-striped" id="ruanganTable">
                    <thead>
                        <tr>
                            <th>No</th>
                            <th>Cover</th>
                            <th>Nama</th>
                            <th>Kapasitas</th>
                            <th>Fasilitas</th>
                            <th>Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($ruangans as $ruangan)
                        <tr>
                            <td>{{ $loop->iteration }}</td>
                            <td><img src="{{ asset('storage/'.$ruangan->cover) }}" alt="cover" width="60"></td>
                            <td>{{ $ruangan->nama }}</td>
                            <td>{{ $ruangan->kapasitas }}</td>
                            <td>{{ $ruangan->fasilitas }}</td>
                            <td width="120">
                                <a href="{{ route('backend.ruangan.show', $ruangan->id) }}" class="btn btn-sm btn-info">View</a>
                                <a href="{{ route('backend.ruangan.edit', $ruangan->id) }}" class="btn btn-sm btn-warning">Edit</a>
                                <form action="{{ route('backend.ruangan.destroy', $ruangan->id) }}" method="POST" class="d-inline">
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
        $('#ruanganTable').DataTable();
    });
</script>
@endpush
