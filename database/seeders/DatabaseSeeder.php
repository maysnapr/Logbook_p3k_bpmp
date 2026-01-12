<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // ==========================================
        // 1. AKUN ADMIN (Untuk Monitoring)
        // ==========================================
        // Email HARUS mengandung kata 'admin' agar bisa akses halaman monitoring
        User::create([
            'name' => 'Administrator BPMP',
            'email' => 'admin@bpmp.go.id', 
            'password' => Hash::make('admin123'), // Login pakai password ini
        ]);

        // ==========================================
        // 2. AKUN PEGAWAI (Untuk Input Logbook)
        // ==========================================
        
        // Pegawai 1
        User::create([
            'name' => 'Budi Santoso, S.Pd',
            'email' => 'budi@bpmp.go.id',
            'password' => Hash::make('pegawai123'), // Login pakai password ini
        ]);

        // Pegawai 2
        User::create([
            'name' => 'Siti Aminah, M.Pd',
            'email' => 'siti@bpmp.go.id',
            'password' => Hash::make('pegawai123'),
        ]);

        // Pegawai 3
        User::create([
            'name' => 'Ahmad Hidayat',
            'email' => 'ahmad@bpmp.go.id',
            'password' => Hash::make('pegawai123'),
        ]);
    }
}