<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use App\Models\bookings;
use App\Models\ruangans;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class UserBookingController extends Controller
{
    public function create()
    {
        $ruangans = ruangans::all();
        return view('booking_create', compact('ruangans'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'ruang_id'    => 'required|exists:ruangans,id',
            'tanggal'     => 'required|date',
            'jam_mulai'   => 'required',
            'jam_selesai' => 'required|after:jam_mulai',
        ]);

        $cekBentrok = bookings::where('ruang_id', $request->ruang_id)
            ->where('tanggal', $request->tanggal)
            ->where(function ($query) use ($request) {
                $query->whereBetween('jam_mulai', [$request->jam_mulai, $request->jam_selesai])
                    ->orWhereBetween('jam_selesai', [$request->jam_mulai, $request->jam_selesai])
                    ->orWhere(function ($q) use ($request) {
                        $q->where('jam_mulai', '<=', $request->jam_mulai)
                          ->where('jam_selesai', '>=', $request->jam_selesai);
                    });
            })
            ->exists();

        if ($cekBentrok) {
            toast('Booking gagal jadwal bentrok !', 'error');
            return back()->with('error', 'Jadwal bentrok dengan jadwal lain!');
        }

        $booking = new bookings();
        $booking->user_id     = Auth::id();
        $booking->ruang_id    = $request->ruang_id;
        $booking->tanggal     = $request->tanggal;
        $booking->jam_mulai   = $request->jam_mulai;
        $booking->jam_selesai = $request->jam_selesai;
        $booking->status      = 'Pending';
        $booking->save();

        toast('Booking sudah diajukan', 'success');
        return redirect()->route('bookings.create');
    }


    public function riwayat()
    {
        $booking = bookings::where('user_id', auth::id())->get();
        // dd($booking);
        return view('bookings_riwayat', compact('booking'));
    }


    
}
