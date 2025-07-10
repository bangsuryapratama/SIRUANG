@extends('layouts.backend')

@section('styles')
<link rel="stylesheet" href="https://cdn.datatables.net/2.3.2/css/dataTables.bootstrap5.css">
@endsection

@section('content')
<div class="container-fluid">
    <div class="card shadow-sm">
        <div class="card-header d-flex justify-content-between align-items-center">
            <h4 class="mb-0">Booking</h4>
            <a href="{{ route('backend.bookings.create') }}" class="btn btn-sm btn-outline-success">Tambah Booking</a>
        </div>

        <div class="card-body">
            <div class="table-responsive">
                <table class="table table-bordered table-striped" id="bookingTable">
                    <thead>
                        <tr>
                            <th>No</th>
                            <th>Nama</th>
                            <th>Ruangan</th>
                            <th width="120">Tanggal</th>
                            <th>Jam Mulai</th>
                            <th>Jam Selesai</th>
                            <th>Status</th>
                            <th width="140">Aksi</th>
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
                            <td width="150">
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
