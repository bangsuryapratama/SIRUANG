<?php

namespace App\Http\Controllers;

use App\Models\Bookings;
use App\Models\Jadwals;
use App\Models\ruangans;
use Illuminate\Support\Facades\Auth;

class FrontendController extends Controller
{
    public function index()
    {
        $bookings = Bookings::with('ruangan')->get();
        $jadwals = Jadwals::with('ruangan')->get();

        $events = [];

        foreach ($bookings as $booking) {
            $events[] = [
                'title' => 'Booking - ' . ($booking->ruangan->nama ?? 'Tanpa Ruangan'),
                'start' => $booking->tanggal . 'T' . $booking->jam_mulai,
                'end' => $booking->tanggal . 'T' . $booking->jam_selesai,
                'color' => '#f39c12',
            ];
        }

        foreach ($jadwals as $jadwal) {
            $events[] = [
                'title' => 'Jadwal - ' . ($jadwal->ruangan->nama ?? 'Tanpa Ruangan'),
                'start' => $jadwal->tanggal . 'T' . $jadwal->jam_mulai,
                'end' => $jadwal->tanggal . 'T' . $jadwal->jam_selesai,
                'color' => '#3498db',
            ];
        }

        return view('welcome', ['jadwal' => $events]);
    }

    public function booking()
    {
        return view('booking_create');
    }


     public function riwayat()
    {
        $booking = bookings::where('user_id', auth::id())->get();
        // dd($booking);
        return view('bookings_riwayat', compact('booking'));
    }


    public function ruanganIndex()
    {
       $ruangans = ruangans::latest()->get();

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
}
