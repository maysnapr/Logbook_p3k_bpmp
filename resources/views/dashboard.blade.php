@extends('layout')

@section('content')
<div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 pb-12">
    
    <!-- Welcome Banner -->
    <div class="bg-blue-900 rounded-2xl p-8 mb-8 text-white shadow-xl flex justify-between items-center relative overflow-hidden">
        <div class="relative z-10">
            <h2 class="text-3xl font-bold">Selamat Datang, {{ Auth::user()->name }}</h2>
            <p class="text-blue-200 mt-2">Sistem Informasi Logbook Kinerja PPPK BPMP</p>
        </div>
        <div class="hidden md:block text-6xl opacity-20 absolute right-10">
            👋
        </div>
    </div>

    <!-- LOGIKA TAMPILAN KHUSUS ADMIN -->
    @if(str_contains(Auth::user()->email, 'admin'))
        <div class="mb-8">
            <!-- Tombol Besar Monitoring -->
            <a href="{{ route('admin.monitoring') }}" class="group block bg-white border border-yellow-200 rounded-2xl p-8 shadow-lg hover:shadow-2xl hover:border-yellow-500 transition-all duration-300 transform hover:-translate-y-1">
                <div class="flex items-center gap-6">
                    <div class="bg-yellow-100 p-6 rounded-2xl group-hover:bg-yellow-500 transition-colors duration-300">
                        <span class="text-5xl group-hover:text-white transition-colors duration-300">👨‍✈️</span>
                    </div>
                    <div>
                        <h3 class="text-2xl font-bold text-gray-800 group-hover:text-yellow-600">Buka Panel Monitoring</h3>
                        <p class="text-gray-500 mt-2 text-lg">Pantau rekapitulasi kinerja seluruh pegawai.</p>
                    </div>
                    <div class="ml-auto bg-gray-50 p-3 rounded-full group-hover:bg-yellow-100 transition">
                        <span class="text-2xl text-gray-400 group-hover:text-yellow-600">→</span>
                    </div>
                </div>
            </a>
        </div>

        <!-- Statistik Ringkas Admin (BARU DITAMBAHKAN) -->
        <h3 class="text-xl font-bold text-gray-800 mb-4">Statistik Keseluruhan (Admin)</h3>
        <div class="grid grid-cols-1 md:grid-cols-3 gap-6 mb-12">
            <!-- Total Semua Logbook -->
            <div class="bg-white p-6 rounded-xl shadow border border-gray-100">
                <p class="text-gray-500 text-sm">Total Logbook Masuk</p>
                <p class="text-3xl font-bold text-gray-800 mt-1">{{ $logs->count() }}</p>
            </div>
            
            <!-- Logbook Bulan Ini -->
            <div class="bg-white p-6 rounded-xl shadow border border-gray-100">
                <p class="text-gray-500 text-sm">Logbook Bulan Ini</p>
                <p class="text-3xl font-bold text-blue-600 mt-1">
                    {{ $logs->filter(fn($l) => \Carbon\Carbon::parse($l->tanggal)->format('Y-m') == date('Y-m'))->count() }}
                </p>
            </div>
            
            <!-- Logbook Hari Ini -->
            <div class="bg-white p-6 rounded-xl shadow border border-gray-100">
                <p class="text-gray-500 text-sm">Logbook Hari Ini</p>
                @php
                    $hariIni = now()->format('Y-m-d');
                    $logsHariIni = $logs->filter(fn($l) => $l->tanggal == $hariIni);
                @endphp
                <p class="text-3xl font-bold text-green-600 mt-1">{{ $logsHariIni->count() }} <span class="text-sm font-normal text-gray-500">Kegiatan</span></p>
            </div>
        </div>

    @else
        <!-- LOGIKA TAMPILAN KHUSUS USER -->
        <!-- Menu Navigasi Utama -->
        <div class="grid grid-cols-1 md:grid-cols-2 gap-8 mb-10">
            <a href="{{ route('logbook.create') }}" class="group block bg-white border border-gray-200 rounded-2xl p-8 shadow-lg hover:shadow-2xl hover:border-blue-500 transition-all duration-300 transform hover:-translate-y-1">
                <div class="flex items-center gap-6">
                    <div class="bg-blue-100 p-5 rounded-2xl group-hover:bg-blue-600 transition-colors duration-300">
                        <span class="text-4xl group-hover:text-white transition-colors duration-300">📝</span>
                    </div>
                    <div>
                        <h3 class="text-2xl font-bold text-gray-800 group-hover:text-blue-600">Input Kegiatan Baru</h3>
                        <p class="text-gray-500 mt-1">Isi laporan kinerja harian anda disini.</p>
                    </div>
                </div>
            </a>

            <a href="{{ route('logbook.history') }}" class="group block bg-white border border-gray-200 rounded-2xl p-8 shadow-lg hover:shadow-2xl hover:border-purple-500 transition-all duration-300 transform hover:-translate-y-1">
                <div class="flex items-center gap-6">
                    <div class="bg-purple-100 p-5 rounded-2xl group-hover:bg-purple-600 transition-colors duration-300">
                        <span class="text-4xl group-hover:text-white transition-colors duration-300">📊</span>
                    </div>
                    <div>
                        <h3 class="text-2xl font-bold text-gray-800 group-hover:text-purple-600">Lihat Riwayat Logbook</h3>
                        <p class="text-gray-500 mt-1">Cek data, foto bukti, dan rekapitulasi.</p>
                    </div>
                </div>
            </a>
        </div>

        <!-- Statistik Ringkas User -->
        <div class="grid grid-cols-1 md:grid-cols-3 gap-6 mb-12">
            <div class="bg-white p-6 rounded-xl shadow border border-gray-100">
                <p class="text-gray-500 text-sm">Total Kegiatan</p>
                <p class="text-3xl font-bold text-gray-800 mt-1">{{ $logs->count() }}</p>
            </div>
            <div class="bg-white p-6 rounded-xl shadow border border-gray-100">
                <p class="text-gray-500 text-sm">Bulan Ini</p>
                <p class="text-3xl font-bold text-blue-600 mt-1">
                    {{ $logs->filter(fn($l) => \Carbon\Carbon::parse($l->tanggal)->format('Y-m') == date('Y-m'))->count() }}
                </p>
            </div>
            <div class="bg-white p-6 rounded-xl shadow border border-gray-100">
                <p class="text-gray-500 text-sm">Kinerja Hari Ini</p>
                @php
                    $hariIni = now()->format('Y-m-d');
                    $logsHariIni = $logs->filter(fn($l) => $l->tanggal == $hariIni);
                @endphp
                <p class="text-3xl font-bold text-green-600 mt-1">{{ $logsHariIni->count() }} <span class="text-sm font-normal text-gray-500">Kegiatan</span></p>
            </div>
        </div>
    @endif

    <!-- ========================================== -->
    <!-- BAGIAN BARU: GALERI AKTIVITAS PEGAWAI (FEED) -->
    <!-- ========================================== -->
    <div class="border-t border-gray-200 pt-8">
        <h3 class="text-xl font-bold text-gray-800 mb-6 flex items-center gap-2">
            <span class="bg-pink-100 text-pink-600 p-2 rounded-lg text-lg">📸</span> 
            Galeri Aktivitas Pegawai
        </h3>
        
        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
            @forelse($feedLogs as $feed)
                <div class="bg-white rounded-xl shadow-sm border border-gray-200 overflow-hidden hover:shadow-md transition-shadow duration-300 flex flex-col h-full">
                    <!-- Bagian Foto -->
                    <div class="h-48 bg-gray-100 relative group overflow-hidden">
                        @if($feed->bukti_foto)
                            <img src="{{ asset('storage/' . $feed->bukti_foto) }}" class="w-full h-full object-cover group-hover:scale-105 transition-transform duration-500">
                        @else
                            <div class="flex flex-col items-center justify-center h-full text-gray-400 bg-gray-50">
                                <span class="text-4xl mb-2">📷</span>
                                <span class="text-xs">Tidak ada foto</span>
                            </div>
                        @endif
                        
                        <!-- Badge Waktu -->
                        <div class="absolute top-2 right-2 bg-black/60 backdrop-blur-sm text-white text-[10px] font-bold px-2 py-1 rounded-full">
                            {{ \Carbon\Carbon::parse($feed->tanggal)->diffForHumans() }}
                        </div>
                    </div>
                    
                    <!-- Bagian Konten -->
                    <div class="p-5 flex-1 flex flex-col">
                        <!-- User Info -->
                        <div class="flex items-center gap-3 mb-3 pb-3 border-b border-gray-100">
                            <div class="w-8 h-8 rounded-full bg-gradient-to-r from-blue-500 to-indigo-600 flex items-center justify-center text-white font-bold text-xs shadow-sm">
                                {{ substr($feed->user->name, 0, 2) }}
                            </div>
                            <div class="overflow-hidden">
                                <p class="text-sm font-bold text-gray-900 truncate">{{ $feed->user->name }}</p>
                                <div class="flex items-center text-[10px] text-gray-500 gap-1">
                                    <span class="text-red-400">📍</span> 
                                    <span class="truncate">{{ $feed->lokasi }}</span>
                                </div>
                            </div>
                        </div>
                        
                        <!-- Deskripsi -->
                        <div class="flex-1">
                            <p class="text-gray-700 text-sm line-clamp-3 mb-2 leading-relaxed">
                                "{{ $feed->kegiatan }}"
                            </p>
                        </div>
                        
                        <!-- Sasaran SKP (Tag) -->
                        <div class="mt-3 pt-2">
                            <span class="inline-block bg-gray-100 text-gray-600 text-[10px] px-2 py-1 rounded font-medium truncate max-w-full">
                                🎯 SKP: {{ Str::limit($feed->sasaran_pekerjaan, 25) }}
                            </span>
                        </div>
                    </div>
                </div>
            @empty
                <div class="col-span-full text-center py-12 bg-gray-50 rounded-xl border border-dashed border-gray-300">
                    <p class="text-gray-400 text-4xl mb-2">📭</p>
                    <p class="text-gray-500">Belum ada aktivitas yang dibagikan.</p>
                </div>
            @endforelse
        </div>
    </div>

</div>
@endsection