<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\LogbookController;

Route::get('/', function () {
    return redirect()->route('login');
});

Route::middleware('guest')->group(function() {
    Route::get('/register', [AuthController::class, 'showRegister'])->name('register');
    Route::post('/register', [AuthController::class, 'register']);
    Route::get('/login', [AuthController::class, 'showLogin'])->name('login');
    Route::post('/login', [AuthController::class, 'login']);
});

Route::middleware('auth')->group(function () {
    Route::post('/logout', [AuthController::class, 'logout'])->name('logout');
    
    // Halaman Dashboard Utama
    Route::get('/dashboard', [LogbookController::class, 'dashboard'])->name('dashboard');
    
    // Halaman Khusus Input
    Route::get('/logbook/input', [LogbookController::class, 'create'])->name('logbook.create');
    Route::post('/logbook/store', [LogbookController::class, 'store'])->name('logbook.store');
    
    // Halaman Khusus Riwayat User (Pribadi)
    Route::get('/logbook/riwayat', [LogbookController::class, 'history'])->name('logbook.history');

    // Halaman Khusus Admin (Monitoring) - INI YANG KEMARIN HILANG
    Route::get('/admin/monitoring', [LogbookController::class, 'adminMonitoring'])->name('admin.monitoring');
});