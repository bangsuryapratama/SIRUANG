<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Foundation\Auth\AuthenticatesUsers;

class LoginController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | Login Controller
    |--------------------------------------------------------------------------
    |
    | This controller handles authenticating users for the application and
    | redirecting them to your home screen. The controller uses a trait
    | to conveniently provide its functionality to your applications.
    |
    */

    use AuthenticatesUsers;

    /**
     * Where to redirect users after login.
     *A\
     * @var string
     */
    protected function redirectTo()
    {
    if (Auth::user()->is_admin == 1) {
        return '/admin';
    }
    return '/';
    }

    protected function sendFailedLoginResponse(Request $request)
    {   
    toast('Email atau password salah!', 'error')->autoclose(4000);
    
    return redirect()->back()
        ->withInput($request->only('email'));
    }

    protected function authenticated(Request $request, $user)
    {
    toast('Login berhasil!', 'success');

    $recent = \App\Models\bookings::where('user_id', $user->id)
        ->whereIn('status', ['Diterima', 'Ditolak'])
        ->where('is_read', false)
        ->latest()
        ->first();

    if ($recent) {
        toast("Booking {$recent->ruangan->nama} baru saja {$recent->status}!", 
              $recent->status === 'Diterima' ? 'success' : 'error');
    }
   }

    public function logout(Request $request)
    {
    Auth::logout();

    $request->session()->invalidate();
    $request->session()->regenerateToken();

    toast('Logout berhasil!', 'success');

    return redirect('/');
    }


    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('guest')->except('logout');
        $this->middleware('auth')->only('logout');
    }
}
