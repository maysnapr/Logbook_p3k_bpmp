@extends('layout')

@section('content')
<div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
    
    <div class="mb-6 flex items-center justify-between">
        <div>
            <h2 class="text-2xl font-bold text-gray-800">Riwayat Logbook</h2>
            <p class="text-gray-500 text-sm">Daftar seluruh laporan kinerja yang telah diinput.</p>
        </div>
        <div class="flex gap-3">
            <a href="{{ route('dashboard') }}" class="bg-white border border-gray-300 text-gray-700 px-4 py-2 rounded-lg hover:bg-gray-50 transition">← Dashboard</a>
            <a href="{{ route('logbook.create') }}" class="bg-blue-600 text-white px-4 py-2 rounded-lg hover:bg-blue-700 transition shadow">+ Tambah Baru</a>
        </div>
    </div>

    @if(session('success'))
        <div class="bg-green-100 border border-green-300 text-green-700 px-4 py-3 rounded-xl mb-6 flex items-center">
            <span class="mr-2">✅</span> {{ session('success') }}
        </div>
    @endif

    <div class="bg-white rounded-2xl shadow-lg border border-gray-200 overflow-hidden">
        <div class="overflow-x-auto">
            <table class="w-full text-left border-collapse">
                <thead class="bg-gray-50 text-gray-600 uppercase text-xs font-bold border-b border-gray-200">
                    <tr>
                        <th class="px-6 py-4 w-32">Bukti Foto</th>
                        <th class="px-6 py-4 w-32">Waktu</th>
                        <th class="px-6 py-4 w-1/5">Lokasi</th> <!-- Kolom Baru -->
                        <th class="px-6 py-4 w-1/5">Sasaran SKP</th>
                        <th class="px-6 py-4">Uraian Kegiatan</th>
                        <th class="px-6 py-4">Hasil (Output)</th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-gray-100">
                    @forelse ($logs as $log)
                    <tr class="hover:bg-blue-50/30 transition-colors">
                        <!-- FOTO LANGSUNG TAMPIL DISINI -->
                        <td class="px-6 py-4 align-top">
                            @if($log->bukti_foto)
                                <a href="{{ asset('storage/' . $log->bukti_foto) }}" target="_blank">
                                    <img src="{{ asset('storage/' . $log->bukti_foto) }}" class="w-24 h-24 object-cover rounded-lg border border-gray-300 shadow-sm hover:scale-105 transition-transform" alt="Bukti">
                                </a>
                            @else
                                <div class="w-24 h-24 bg-gray-100 rounded-lg flex items-center justify-center text-gray-400 border border-gray-200">
                                    <span class="text-xs">No Image</span>
                                </div>
                            @endif
                        </td>
                        
                        <!-- Waktu & Durasi -->
                        <td class="px-6 py-4 align-top">
                            <div class="font-bold text-gray-900">{{ \Carbon\Carbon::parse($log->tanggal)->format('d/m/Y') }}</div>
                            <div class="text-xs text-gray-500 mt-1 mb-2">
                                {{ \Carbon\Carbon::parse($log->jam_mulai)->format('H:i') }} - 
                                {{ \Carbon\Carbon::parse($log->jam_selesai)->format('H:i') }}
                            </div>
                            
                            @php
                                $mulai = \Carbon\Carbon::parse($log->jam_mulai);
                                $selesai = \Carbon\Carbon::parse($log->jam_selesai);
                                $durasi = $selesai->diffInMinutes($mulai);
                            @endphp
                            <div class="flex flex-wrap gap-1">
                                <span class="inline-block bg-gray-100 text-gray-600 text-[10px] font-bold px-2 py-1 rounded-full border border-gray-200">
                                    ⏱ {{ $durasi }} Menit
                                </span>
                            </div>
                        </td>

                        <!-- Kolom Lokasi (Baru) -->
                        <td class="px-6 py-4 align-top">
                             <div class="text-sm text-gray-700 font-medium flex items-start gap-1">
                                <span>📍</span> 
                                <span>{{ $log->lokasi }}</span>
                            </div>
                        </td>

                        <!-- Kolom Sasaran SKP -->
                        <td class="px-6 py-4 align-top">
                            <span class="bg-blue-100 text-blue-800 text-[10px] font-bold px-2 py-1 rounded border border-blue-200 uppercase tracking-wide inline-block leading-relaxed">
                                {{ $log->sasaran_pekerjaan }}
                            </span>
                        </td>

                        <!-- Kolom Uraian Kegiatan -->
                        <td class="px-6 py-4 align-top">
                            <p class="text-gray-800 font-medium leading-relaxed">{{ $log->kegiatan }}</p>
                        </td>

                        <td class="px-6 py-4 align-top text-gray-600">
                            {{ $log->output }}
                        </td>
                    </tr>
                    @empty
                    <tr>
                        <td colspan="6" class="px-6 py-16 text-center text-gray-500">
                            <p class="text-xl">📭</p>
                            <p class="mt-2">Belum ada data logbook.</p>
                        </td>
                    </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
        
        <!-- Pagination Links -->
        <div class="px-6 py-4 border-t border-gray-200 bg-gray-50">
            {{ $logs->links() }}
        </div>
    </div>
</div>
@endsection