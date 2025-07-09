<?php

use App\Http\Controllers\Backend\RuanganController;
use App\Http\Controllers\Backend\UserController;
use App\Http\Controllers\BackendController;
use App\Http\Controllers\Backend\JadwalController;
use App\Http\Middleware\Admin;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Auth;

Route::get('/', function () {
    return view('welcome');
});

Auth::routes();

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');

Route::group(['prefix' => 'admin', 'as' => 'backend.', 'middleware' => ['auth', Admin::class]], function () {
    Route::get('/', [BackendController::class, 'index']);
    
  

    // // crud resource
    Route::resource('/user', UserController::class);
    Route::resource('/ruangan', RuanganController::class);
    Route::resource('/jadwal', JadwalController::class);
    // Route::resource('/ruangan', RuanganController::class);
    
});

