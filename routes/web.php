<?php

use App\Http\Controllers\Auth\LoginController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\KartuKeluargaController;
use App\Http\Controllers\KeluargaController;
use App\Http\Controllers\MutasiController;
use App\Http\Controllers\PendudukController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
})->name('home');

Route::middleware('guest')->group(function () {
    Route::get('login', [LoginController::class, 'showLoginForm'])->name('login');
    Route::post('login', [LoginController::class, 'login']);
});

Route::post('logout', [LoginController::class, 'logout'])->name('logout');

Route::middleware('auth')->group(function () {
    Route::get('dashboard', [DashboardController::class, 'index'])->name('dashboard');

    Route::resource('penduduk', PendudukController::class);
    Route::resource('kartu-keluarga', KartuKeluargaController::class);
    Route::resource('mutasi', MutasiController::class)->only(['index', 'create', 'store', 'show']);

    Route::resource('keluarga', KeluargaController::class)->only(['index', 'create', 'store', 'show', 'edit', 'update', 'destroy']);
    Route::post('keluarga/{keluarga}/anggota', [KeluargaController::class, 'storeAnggota'])->name('keluarga.anggota.store');
    Route::put('keluarga/{keluarga}/anggota/{penduduk}', [KeluargaController::class, 'updateAnggota'])->name('keluarga.anggota.update');
    Route::delete('keluarga/{keluarga}/anggota/{penduduk}', [KeluargaController::class, 'destroyAnggota'])->name('keluarga.anggota.destroy');
});
