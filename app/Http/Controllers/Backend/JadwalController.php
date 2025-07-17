<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use App\Models\jadwals;
use App\Models\ruangans;
use App\Models\bookings;
use Carbon\Carbon;
use Illuminate\Http\Request;

class JadwalController extends Controller
{
    public function index()
    {
        $jadwals = jadwals::all()->map(function ($jadwal) {
            $jadwal->tanggal_format = Carbon::parse($jadwal->tanggal)->translatedFormat('l, j F Y');
            return $jadwal;
        });

        $title = 'Hapus Data!';
        $text  = "Apakah anda yakin ingin menghapus jadwal ini?";
        confirmDelete($title, $text);

        return view('backend.jadwal.index', compact('jadwals'));
    }

    public function create()
    {
        $ruangans = ruangans::all();
        return view('backend.jadwal.create', compact('ruangans'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'ruang_id'    => 'required|exists:ruangans,id',
            'tanggal'     => 'required|date',
            'jam_mulai'   => 'required|string',
            'jam_selesai' => 'required|string|after:jam_mulai',
            'ket'         => 'required|string',
        ], [
            'ruang_id.required'     => 'Ruangan wajib dipilih.',
            'ruang_id.exists'       => 'Ruangan yang dipilih tidak ditemukan.',
            'tanggal.required'      => 'Tanggal wajib diisi.',
            'tanggal.date'          => 'Format tanggal tidak valid.',
            'jam_mulai.required'    => 'Jam mulai wajib diisi.',
            'jam_selesai.required'  => 'Jam selesai wajib diisi.',
            'jam_selesai.after'     => 'Jam selesai harus lebih dari jam mulai.',
            'ket.required'          => 'Keterangan wajib diisi.',
        ]);

        // Cek bentrok dengan booking pengguna
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
            toast('Jadwal tetap bentrok dengan booking pengguna!', 'error');
            return back()->withInput()->with('error', 'Jadwal bertabrakan dengan booking yang sudah ada.');
        }

        $jadwals = new jadwals();
        $jadwals->ruang_id    = $request->ruang_id;
        $jadwals->tanggal     = $request->tanggal;
        $jadwals->jam_mulai   = $request->jam_mulai;
        $jadwals->jam_selesai = $request->jam_selesai;
        $jadwals->ket         = $request->ket;
        $jadwals->save();

        toast('Data jadwal berhasil disimpan.', 'success');
        return redirect()->route('backend.jadwal.index');
    }

    public function show(string $id)
    {
        $jadwal = jadwals::findOrFail($id);
        $jadwal->tanggal_format = Carbon::parse($jadwal->tanggal)->translatedFormat('l, j F Y');

        return view('backend.jadwal.show', compact('jadwal'));
    }

    public function edit($id)
    {
        $jadwal = jadwals::findOrFail($id);
        $ruangans = ruangans::all();

        return view('backend.jadwal.edit', compact('jadwal', 'ruangans'));
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'ruang_id'    => 'required|exists:ruangans,id',
            'tanggal'     => 'required|date',
            'jam_mulai'   => 'required|string',
            'jam_selesai' => 'required|string|after:jam_mulai',
            'ket'         => 'required|string',
        ], [
            'ruang_id.required'     => 'Ruangan wajib dipilih.',
            'ruang_id.exists'       => 'Ruangan yang dipilih tidak ditemukan.',
            'tanggal.required'      => 'Tanggal wajib diisi.',
            'tanggal.date'          => 'Format tanggal tidak valid.',
            'jam_mulai.required'    => 'Jam mulai wajib diisi.',
            'jam_selesai.required'  => 'Jam selesai wajib diisi.',
            'jam_selesai.after'     => 'Jam selesai harus lebih dari jam mulai.',
            'ket.required'          => 'Keterangan wajib diisi.',
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
            toast('Jadwal tetap bentrok dengan booking pengguna!', 'error');
            return back()->withInput()->with('error', 'Jadwal bertabrakan dengan booking yang sudah ada.');
        }

        $jadwal = jadwals::findOrFail($id);
        $jadwal->ruang_id    = $request->ruang_id;
        $jadwal->tanggal     = $request->tanggal;
        $jadwal->jam_mulai   = $request->jam_mulai;
        $jadwal->jam_selesai = $request->jam_selesai;
        $jadwal->ket         = $request->ket;
        $jadwal->save();

        toast('Jadwal berhasil diperbarui.', 'success');
        return redirect()->route('backend.jadwal.index');
    }

    public function destroy(string $id)
    {
        $jadwal = jadwals::findOrFail($id);
        $jadwal->delete();

        toast('Data jadwal berhasil dihapus.', 'success');
        return redirect()->route('backend.jadwal.index');
    }
}
