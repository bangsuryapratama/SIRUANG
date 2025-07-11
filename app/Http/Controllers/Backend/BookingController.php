<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use App\Models\bookings;
use App\Models\ruangans;
use App\Models\User;
use Illuminate\Http\Request;
use Carbon\Carbon;
use Barryvdh\DomPDF\Facade\Pdf;

class BookingController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }


     public function export()
    {
        
    $bookings = bookings::all();

    $pdf = Pdf::loadView('backend.bookings.pdfbookings', ['bookings' => $bookings]);
    return $pdf->download('laporan-data-bookings.pdf');
    }

    public function index(Request $request)
    {
        //status otomatis
        bookings::where(function ($query) {
            $query->where('tanggal', '<', now()->toDateString())
                  ->orWhere(function ($q) {
                      $q->where('tanggal', now()->toDateString())
                        ->where('jam_selesai', '<', now()->format('H:i:s'));
                  });
        })
        ->where('status', '!=', 'Selesai')
        ->update(['status' => 'Selesai']);

        //bentrok
        $bookings = bookings::with(['ruangan', 'user'])
            ->latest()
            ->get()
            ->map(function ($booking) {
                $booking->tanggal_format = Carbon::parse($booking->tanggal)->translatedFormat('l, j F Y');
                return $booking;
            });

        confirmDelete('Hapus Booking', 'Apakah Anda yakin ingin menghapus booking ini?');
        return view('backend.bookings.index', compact('bookings'));
    }

    public function create()
    {
        $ruangans = ruangans::all();
        $users = User::all();
        return view('backend.bookings.create', compact('ruangans', 'users'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'user_id'     => 'required|exists:users,id',
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

        $booking = new bookings;
        $booking->user_id     = $request->user_id;
        $booking->ruang_id    = $request->ruang_id;
        $booking->tanggal     = $request->tanggal;
        $booking->jam_mulai   = $request->jam_mulai;
        $booking->jam_selesai = $request->jam_selesai;
        $booking->status      = 'Pending';
        $booking->save();

        toast('Booking berhasil ditambahkan.', 'success');
        return redirect()->route('backend.bookings.index');
    }

    public function show($id)
    {
        $booking = bookings::with(['ruangan', 'user'])->findOrFail($id);
        $booking->tanggal_format = Carbon::parse($booking->tanggal)->translatedFormat('l, j F Y');
        return view('backend.bookings.show', compact('booking'));
    }

    public function edit($id)
    {
        $booking = bookings::findOrFail($id);
        $ruangans = ruangans::all();
        $users = User::all();
        return view('backend.bookings.edit', compact('booking', 'ruangans', 'users'));
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'user_id'     => 'required|exists:users,id',
            'ruang_id'    => 'required|exists:ruangans,id',
            'tanggal'     => 'required|date',
            'jam_mulai'   => 'required',
            'jam_selesai' => 'required|after:jam_mulai',
            'status'      => 'required|in:Pending,Diterima,Ditolak,Selesai',
        ]);

        $booking = bookings::findOrFail($id);
        $booking->user_id     = $request->user_id;
        $booking->ruang_id    = $request->ruang_id;
        $booking->tanggal     = $request->tanggal;
        $booking->jam_mulai   = $request->jam_mulai;
        $booking->jam_selesai = $request->jam_selesai;
        $booking->status      = $request->status;
        $booking->save();

        toast('Booking berhasil diperbarui.', 'success');
        return redirect()->route('backend.bookings.index');
    }

    public function destroy($id)
    {
        $booking = bookings::findOrFail($id);
        $booking->delete();

        toast('Booking berhasil dihapus.', 'success');
        return redirect()->route('backend.bookings.index');
    }
}