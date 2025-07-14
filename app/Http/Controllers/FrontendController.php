<?php

namespace App\Http\Controllers;

use App\Models\Bookings;
use App\Models\Jadwals;
use App\Models\ruangans;
use Illuminate\Support\Facades\Auth;
use Barryvdh\DomPDF\Facade\Pdf;
use Illuminate\Http\Request;

class FrontendController extends Controller
{
    public function index()
    {
    $bookings = Bookings::with('ruangan')
        ->whereIn('status', ['Diterima', 'Selesai'])
        ->get();

    $jadwals = Jadwals::with('ruangan')->get();

    $events = [];

    foreach ($bookings as $booking) {
    $events[] = [
        'title' => 'Booking - ' . ($booking->ruangan->nama ?? 'Tanpa Ruangan'),
        'start' => $booking->tanggal . 'T' . $booking->jam_mulai,
        'end'   => $booking->tanggal . 'T' . $booking->jam_selesai,
        'color' => '#f39c12',
        'description' => 'Nama: ' . $booking->user->name . '<br> Status: ' . $booking->status,

    ];


    }

    foreach ($jadwals as $jadwal) {
        $events[] = [
            'title' => 'Jadwal - ' . ($jadwal->ruangan->nama ?? 'Tanpa Ruangan'),
            'start' => $jadwal->tanggal . 'T' . $jadwal->jam_mulai,
            'end'   => $jadwal->tanggal . 'T' . $jadwal->jam_selesai,
            'color' => '#3498db',
            'description' => 'Keterangan: ' . $jadwal->ket,

        ];
    }

    return view('welcome', ['jadwal' => $events]);
    }

    public function booking()
    {
        return view('booking_create');
    }


    public function riwayat(Request $request)
    {
        $query = Bookings::where('user_id', Auth::id())->with('ruangan');

        if ($request->filled('ruang_id')) {
            $query->where('ruang_id', $request->ruang_id);
        }

        if ($request->filled('status')) {
            $query->where('status', $request->status);
        }

        if ($request->filled('tanggal')) {
            $query->whereDate('tanggal', $request->tanggal);
        }

        $booking = $query->orderBy('tanggal', 'desc')->get();
        $ruangans = ruangans::orderBy('nama', 'asc')->get();

        return view('bookings_riwayat', compact('booking', 'ruangans'));
    }




    public function ruanganIndex()
    {
      $ruangans = ruangans::orderBy('id', 'asc')->get();


        $title = 'Hapus Data!';
        $text  = "Apakah anda yakin ingin menghapus ruangan ini?";
        confirmDelete($title, $text);

        return view('ruangan', compact('ruangans'));
        
    }

    public function ruanganShow(string $id)
    {
        $ruangan = ruangans::findOrFail($id);
        return view('ruangan_detail', compact('ruangan'));
    }

    public function export()
    {
    $bookings = Bookings::where('user_id', Auth::id())->with('ruangan')->get();

    $pdf = Pdf::loadView('riwayat_pdf', ['bookings' => $bookings]);
    return $pdf->download('riwayat-booking-' . Auth::user()->name . '.pdf');
    }

}
