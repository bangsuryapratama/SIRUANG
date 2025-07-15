<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use App\Models\bookings;
use App\Models\jadwals;
use App\Models\ruangans;
use Barryvdh\DomPDF\Facade\Pdf;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class UserBookingController extends Controller
{
    public function export()
    {
        $query = Bookings::where('user_id', Auth::id())->with('ruangan');

        if (request()->filled('ruang_id')) {
            $query->where('ruang_id', request('ruang_id'));
        }

        if (request()->filled('status')) {
            $query->where('status', request('status'));
        }

        if (request()->filled('tanggal')) {
            $query->whereDate('tanggal', request('tanggal'));
        }

        $bookings = $query->orderBy('tanggal', 'desc')->get();

        $pdf = Pdf::loadView('riwayat_pdf', ['bookings' => $bookings]);
        return $pdf->download('riwayat-booking-' . Auth::user()->name . '.pdf');
    }

    public function create()
    {
        $ruangans = ruangans::orderBy('id', 'asc')->get();
        return view('booking_create', compact('ruangans'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'ruang_id'    => 'required|exists:ruangans,id',
            'tanggal'     => 'required|date|after_or_equal:today',
            'jam_mulai'   => 'required|date_format:H:i',
            'jam_selesai' => 'required|date_format:H:i|after:jam_mulai',
        ]);

        $tanggal = Carbon::parse($request->tanggal);
        $jamSelesai = Carbon::parse($request->tanggal . ' ' . $request->jam_selesai);
        $jamMulai = Carbon::parse($request->tanggal . ' ' . $request->jam_mulai);

        if ($tanggal->isToday() && $jamMulai->lt(now())) {
            toast('Jam mulai harus setelah waktu sekarang.', 'error')->autoClose(4000);
            return back()->withInput();
        }

          // if (Carbon::parse($request->tanggal)->isPast()) {
        //     toast('Tanggal booking tidak boleh di masa lalu!', 'error');
        //     return back()->withInput()->with('error', 'Tanggal booking minimal hari ini.');
        // }

        // Bentrok dengan jadwal tetap
        $hariBooking = $tanggal->locale('id')->isoFormat('dddd');
        $jadwalTetaps = jadwals::where('ruang_id', $request->ruang_id)->get();
        foreach ($jadwalTetaps as $jadwal) {
            $hariJadwal = Carbon::parse($jadwal->tanggal)->locale('id')->isoFormat('dddd');
            if ($hariJadwal === $hariBooking) {
                if (
                    ($request->jam_mulai >= $jadwal->jam_mulai && $request->jam_mulai < $jadwal->jam_selesai) ||
                    ($request->jam_selesai > $jadwal->jam_mulai && $request->jam_selesai <= $jadwal->jam_selesai) ||
                    ($request->jam_mulai <= $jadwal->jam_mulai && $request->jam_selesai >= $jadwal->jam_selesai)
                ) {
                    toast('Jadwal bentrok dengan jadwal tetap ruangan.', 'error')->autoClose(4000);
                    return back()->withInput();
                }
            }
        }

        // Bentrok dengan booking lain
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
            toast('Jadwal bentrok dengan booking lain.', 'error')->autoClose(4000);
            return back()->withInput();
        }

        // Jeda 30 menit
        $lastBooking = bookings::where('ruang_id', $request->ruang_id)
            ->where('tanggal', $request->tanggal)
            ->where('jam_selesai', '<=', $request->jam_mulai)
            ->orderBy('jam_selesai', 'desc')
            ->first();

        if ($lastBooking) {
            $lastEnd = Carbon::parse($request->tanggal . ' ' . $lastBooking->jam_selesai);
            if ($lastEnd->gt($jamMulai->subMinutes(30))) {
                toast('Harus ada jeda 30 menit setelah pemakaian sebelumnya.', 'error')->autoClose(4000);
                return back()->withInput();
            }
        }

        bookings::create([
            'user_id'     => Auth::id(),
            'ruang_id'    => $request->ruang_id,
            'tanggal'     => $request->tanggal,
            'jam_mulai'   => $request->jam_mulai,
            'jam_selesai' => $request->jam_selesai,
            'status'      => 'Pending',
        ]);

        toast('Booking berhasil diajukan.', 'success')->autoClose(4000);
        return redirect()->route('bookings.create');
    }
}
