<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('logbooks', function (Blueprint $table) {
            $table->id();
            // Menghubungkan logbook dengan tabel user
            $table->foreignId('user_id')->constrained()->onDelete('cascade'); 
            
            $table->date('tanggal');
            
            // KOLOM BARU: Lokasi Kegiatan (Wajib Ada)
            $table->string('lokasi'); 

            // Kolom Sasaran Pekerjaan (SKP)
            $table->string('sasaran_pekerjaan'); 

            $table->time('jam_mulai');
            $table->time('jam_selesai');
            $table->text('kegiatan');
            $table->string('output'); // Contoh: Laporan Selesai
            
            // Menggunakan bukti_foto string untuk path file
            $table->string('bukti_foto')->nullable(); 
            
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('logbooks');
    }
};