<?php

namespace App\Http\Controllers;

use App\Models\Bookings;
use App\Models\Jadwals;

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
}
