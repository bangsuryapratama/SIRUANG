<?php

use App\Http\Controllers\BackendController;
use App\Http\Controllers\FrontendController;
use App\Http\Middleware\AdminMiddleware;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Auth;


Route::get('/', function () {
    if (!Auth::check()) {
        return redirect()->route('login');
    }

    if (Auth::user()->isAdmin == 1) {
        return redirect()->route('admin');
    }

    Route::get('/', function () {
    if (!Auth::check()) {
        return redirect()->route('login');
    }
 
});


    return redirect()->route('welcome');
});

Route::get('/', [FrontendController::class, 'index']);

Auth::routes();

Route::get('/welcome', [App\Http\Controllers\HomeController::class, 'index'])->name('welcome');



//Route AKSES BLOKIR
Route::middleware('is_admin')->group(function () {
    // Route::resource('pengguna', PenggunasController::class);
});

Route::group(['prefix' => 'admin', 'as' => 'backend.', 'middleware' => ['auth', AdminMiddleware::class]], function () {
    Route::get('/', [BackendController::class, 'index']);

});
