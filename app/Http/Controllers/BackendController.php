<?php

namespace App\Http\Controllers;

use App\Models\bookings;
use App\Models\jadwals;
use App\Models\ruangans;
use App\Models\User;

class BackendController extends Controller
{
    
    public function index()
    {
       $data = [
        'user' => User::count(),
        'ruangan' => ruangans::count(),
        'jadwal' => jadwals::count(),
        'booking' => bookings::count(),
        'events' => bookings::with('ruangan')->get()->map(function ($item) {
            return [
                'title' => $item->ruangan->nama,
                'start' => $item->tanggal . 'T' . $item->jam_mulai,
                'end' => $item->tanggal . 'T' . $item->jam_selesai,
            ];
        })
    ];

    return view('backend.index', $data);
    }
}