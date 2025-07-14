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
            'tanggal'     => 'required|date',
            'jam_mulai'   => 'required',
            'jam_selesai' => 'required|after:jam_mulai',
        ]);

        $tanggalInput = Carbon::parse($request->tanggal)->format('Y-m-d');
        $hariIni = Carbon::now()->format('Y-m-d');

        if ($tanggalInput === $hariIni) {
            $jamSelesai = Carbon::parse($request->tanggal . ' ' . $request->jam_selesai);
            if ($jamSelesai->lt(Carbon::now())) {
                return back()
                    ->withInput()
                    ->with('error', 'Waktu booking sudah lewat. Silakan pilih waktu yang valid.');
            }
        }

        // Cek bentrok dengan jadwal tetap (Jadwal model)
        $tanggal = Carbon::parse($request->tanggal);
        $hariBooking = $tanggal->locale('id')->isoFormat('dddd'); 

        $jadwalTetaps = jadwals::where('ruang_id', $request->ruang_id)->get();

        foreach ($jadwalTetaps as $jadwal) {
            $hariJadwal = Carbon::parse($jadwal->tanggal)->locale('id')->isoFormat('dddd');

            if ($hariJadwal === $hariBooking) {
                if (($request->jam_mulai >= $jadwal->jam_mulai && $request->jam_mulai < $jadwal->jam_selesai) || ($request->jam_selesai > $jadwal->jam_mulai && $request->jam_selesai <= $jadwal->jam_selesai) || ($request->jam_mulai <= $jadwal->jam_mulai && $request->jam_selesai >= $jadwal->jam_selesai)) {
                    toast('Jadwal bentrok dengan jadwal tetap ruangan.', 'error')->autoClose(4000);
                    return back()->withInput();
                }
            }
        }

        //fungsibentrokbooking
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
            toast('Jadwal bentrok dengan jadwal lain!', 'error');
            return back()->withInput()->with('error', 'Jadwal bentrok dengan jadwal lain!');
        }

        //harus jeda 30
        $lastBooking = bookings::where('ruang_id', $request->ruang_id)
            ->where('tanggal', $request->tanggal)
            ->where('jam_selesai', '<=', $request->jam_mulai)
            ->orderBy('jam_selesai', 'desc')
            ->first();

        if ($lastBooking) {
            $lastEnd = Carbon::parse($request->tanggal . ' ' . $lastBooking->jam_selesai);
            $newStart = Carbon::parse($request->tanggal . ' ' . $request->jam_mulai);

            if ($lastEnd->gt($newStart->subMinutes(30))) {
                toast('Harus ada jeda 30 menit setelah pemakaian sebelumnya!', 'error');
                return back()->withInput()->with('error', 'Harus ada jeda 30 menit setelah pemakaian sebelumnya!');
            }
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
}
