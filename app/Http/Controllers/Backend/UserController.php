<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\ValidationException;

class UserController extends Controller
{
    public function index()
    {
        $user = User::all();
        return view('backend.user.index', compact('user'));
    }

    public function create()
    {
        return view('backend.user.create');
    }

    public function store(Request $request)
    {
        try {
            $request->validate([
                'name'     => 'required|string|max:255',
                'email'    => 'required|email|unique:users,email',
                'password' => 'required|string|min:6|confirmed',
            ], [
                'email.unique'      => 'Email sudah digunakan.',
                'email.required'    => 'Email wajib diisi.',
                'password.confirmed'=> 'Konfirmasi password tidak cocok.',
            ]);

            $user = new User;
            $user->name     = $request->name;
            $user->email    = $request->email;
            $user->password = Hash::make($request->password);
            $user->is_admin = $request->has('is_admin');
            $user->save();

            toast('User berhasil ditambahkan!', 'success');
            return redirect()->route('backend.user.index');
        } catch (ValidationException $e) {
            foreach ($e->validator->errors()->all() as $error) {
                toast($error, 'error');
            }
            return redirect()->back()->withErrors($e->validator)->withInput();
        }
    }

    public function edit(User $user)
    {
        return view('backend.user.edit', compact('user'));
    }

    public function update(Request $request, User $user)
    {
        try {
            $request->validate([
                'name'     => 'required|string|max:255',
                'email'    => 'required|email|unique:users,email,' . $user->id,
                'password' => 'nullable|string|min:6|confirmed',
            ], [
                'email.unique'      => 'Email sudah digunakan oleh pengguna lain.',
                'email.required'    => 'Email wajib diisi.',
                'password.confirmed'=> 'Konfirmasi password tidak cocok.',
            ]);

            $user->name  = $request->name;
            $user->email = $request->email;

            if ($request->filled('password')) {
                $user->password = Hash::make($request->password);
            }

            $user->is_admin = $request->has('is_admin');
            $user->save();

            toast('User berhasil diupdate!', 'success');
            return redirect()->route('backend.user.index');
        } catch (ValidationException $e) {
            foreach ($e->validator->errors()->all() as $error) {
                toast($error, 'error');
            }
            return redirect()->back()->withErrors($e->validator)->withInput();
        }
    }

    public function destroy(User $user)
    {
        if ($user->bookings()->count() > 0) {
        toast('Tidak bisa menghapus user karena masih digunakan di data booking.', 'error');
        return back();
    }
        $user->delete();
        toast('User berhasil dihapus!', 'success');
        return redirect()->route('backend.user.index');
    }
}
