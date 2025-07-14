@extends('layouts.backend')

@section('styles')
    <link rel="stylesheet" href="https://cdn.datatables.net/2.3.2/css/dataTables.bootstrap5.css">
@endsection

@section('content')
<div class="container-fluid">
    <div class="card shadow-sm">
        <div class="card-header d-flex justify-content-between align-items-center">
            <h4 class="mb-0">Booking</h4>
            <div>
                <a href="{{ route('backend.bookings.export',
                [
                    'ruang_id' => request('ruang_id'),
                    'tanggal'  => request('tanggal'),
                    'status'   => request('status'),
                ]) }}" class="btn btn-sm btn-danger me-2">
                    <i class="fa fa-file-pdf"></i> Export PDF
                </a>
                <a href="{{ route('backend.bookings.create') }}" class="btn btn-sm btn-outline-success">
                    Tambah Booking
                </a>
            </div>
        </div>

        {{-- Filter Form --}}
        <div class="px-3 py-3">
            <form method="GET" action="{{ route('backend.bookings.index') }}">
                <div class="row">
                    <div class="col-md-3 mb-2">
                        <select name="ruang_id" class="form-select">
                            <option value="">-- Filter Ruangan --</option>
                            @foreach ($ruangans as $data)
                                <option value="{{ $data->id }}" {{ request('ruang_id') == $data->id ? 'selected' : '' }}>
                                    {{ $data->nama }}
                                </option>
                            @endforeach
                        </select>
                    </div>
                    <div class="col-md-3 mb-2">
                        <input type="date" name="tanggal" class="form-control" value="{{ request('tanggal') }}">
                    </div>
                    <div class="col-md-3 mb-2">
                        <select name="status" class="form-select">
                            <option value="">-- Filter Status --</option>
                            <option value="Pending"   {{ request('status') == 'Pending' ? 'selected' : '' }}>Pending</option>
                            <option value="Diterima"  {{ request('status') == 'Diterima' ? 'selected' : '' }}>Diterima</option>
                            <option value="Ditolak"   {{ request('status') == 'Ditolak' ? 'selected' : '' }}>Ditolak</option>
                            <option value="Selesai"   {{ request('status') == 'Selesai' ? 'selected' : '' }}>Selesai</option>
                        </select>
                    </div>
                    <div class="col-md-3 mb-2">
                        <button type="submit" class="btn btn-sm btn-primary me-2">Terapkan Filter</button>
                        <a href="{{ route('backend.bookings.index') }}" class="btn btn-sm btn-info">Reset</a>
                    </div>
                </div>
            </form>
        </div>

        {{-- Table --}}
        <div class="card-body">
            <div class="table-responsive">
                <table class="table table-bordered table-striped" id="bookingTable">
                    <thead class="table-light">
                        <tr>
                            <th>No</th>
                            <th>Nama</th>
                            <th>Ruangan</th>
                            <th width="120">Tanggal</th>
                            <th>Jam Mulai</th>
                            <th>Jam Selesai</th>
                            <th>Status</th>
                            <th width="170">Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($bookings as $booking)
                            <tr>
                                <td>{{ $loop->iteration }}</td>
                                <td>{{ $booking->user->name }}</td>
                                <td>{{ $booking->ruangan->nama }}</td>
                                <td>{{ $booking->tanggal_format }}</td>
                                <td>{{ $booking->jam_mulai }}</td>
                                <td>{{ $booking->jam_selesai }}</td>
                                <td>{{ $booking->status }}</td>
                                <td>
                                    <a href="{{ route('backend.bookings.show', $booking->id) }}" class="btn btn-sm btn-info">Detail</a>
                                    <a href="{{ route('backend.bookings.edit', $booking->id) }}" class="btn btn-sm btn-warning">Edit</a>
                                    <form action="{{ route('backend.bookings.destroy', $booking->id) }}" method="POST" class="d-inline">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="btn btn-sm btn-danger" onclick="return confirm('Yakin hapus data ini?')">Hapus</button>
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
            $('#bookingTable').DataTable();
        });
    </script>
@endpush
