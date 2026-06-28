<?php

use App\Http\Controllers\AuthController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\DosenController;
use App\Http\Controllers\JadwalController;
use App\Http\Controllers\KrsController;
use App\Http\Controllers\MahasiswaController;
use App\Http\Controllers\MataKuliahController;
use App\Models\User;
use Illuminate\Support\Facades\Route;

Route::redirect('/', '/login');

Route::middleware('guest')->group(function () {
    Route::get('/login', [AuthController::class, 'showLogin'])->name('login');
    Route::post('/login', [AuthController::class, 'login'])->name('login.submit');
});

Route::post('/logout', [AuthController::class, 'logout'])
    ->name('logout')
    ->middleware('auth');

Route::middleware('auth')->group(function () {

    Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard');

    Route::middleware('peran:'.User::ROLE_ADMIN)->group(function () {
        Route::resource('dosen', DosenController::class)->except('show');
        Route::resource('mahasiswa', MahasiswaController::class)->except('show');
        Route::resource('matakuliah', MataKuliahController::class)->except('show');
        Route::resource('jadwal', JadwalController::class)->except('show');

        Route::get('/krs', [KrsController::class, 'index'])->name('krs.index');
    });

    Route::middleware('peran:'.User::ROLE_MAHASISWA)->group(function () {
        Route::get('/krs-saya', [KrsController::class, 'milikSaya'])->name('krs.milikSaya');
        Route::post('/krs-saya', [KrsController::class, 'store'])->name('krs.store');
    });

    Route::delete('/krs/{krs}', [KrsController::class, 'destroy'])->name('krs.destroy');
});
