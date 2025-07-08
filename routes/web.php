<?php

use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Auth;

Route::get('/', function () {
    return view('welcome');
});

Auth::routes();

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');



//Route AKSES BLOKIR
Route::middleware('is_admin')->group(function () {
    // Route::resource('pengguna', PenggunasController::class);
});