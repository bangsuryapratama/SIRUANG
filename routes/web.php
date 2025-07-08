<?php

use App\Http\Controllers\BackendController;
use App\Http\Middleware\AdminMiddleware;
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

Route::group(['prefix' => 'admin', 'as' => 'backend.', 'middleware' => ['auth', AdminMiddleware::class]], function () {
    Route::get('/', [BackendController::class, 'index']);

});
