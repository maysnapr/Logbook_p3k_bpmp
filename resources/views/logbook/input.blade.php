@extends('layout')

@section('content')
<div class="max-w-4xl mx-auto px-4 sm:px-6 lg:px-8">
    
    <div class="mb-6 flex items-center justify-between">
        <h2 class="text-2xl font-bold text-gray-800">Formulir Logbook Harian</h2>
        <a href="{{ route('dashboard') }}" class="text-sm text-gray-500 hover:text-blue-600">← Kembali ke Dashboard</a>
    </div>

    <div class="bg-white rounded-2xl shadow-xl border border-gray-200 overflow-hidden">
        <div class="bg-blue-600 px-8 py-4">
            <p class="text-blue-100 text-sm">Silakan isi data kinerja sesuai SKP.</p>
        </div>
        
        <div class="p-8">
            <form method="POST" action="{{ route('logbook.store') }}" enctype="multipart/form-data" class="space-y-6">
                @csrf
                
                <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                    <!-- Tanggal -->
                    <div>
                        <label class="block text-sm font-bold text-gray-700 mb-2">Tanggal Kegiatan</label>
                        <input type="date" name="tanggal" value="{{ date('Y-m-d') }}" required 
                               class="w-full border-gray-300 rounded-lg p-3 focus:ring-2 focus:ring-blue-500 border bg-gray-50 cursor-pointer"
                               onclick="this.showPicker()">
                    </div>
                    
                    <!-- Lokasi (Wajib diisi sesuai Controller) -->
                    <div>
                        <label class="block text-sm font-bold text-gray-700 mb-2">Lokasi Kegiatan</label>
                        <input type="text" name="lokasi" placeholder="Contoh: Aula BPMP, SMKN 1 Kendari..." required class="w-full border-gray-300 rounded-lg p-3 focus:ring-2 focus:ring-blue-500 border bg-gray-50">
                    </div>
                </div>

                <!-- Sasaran SKP -->
                <div>
                    <label class="block text-sm font-bold text-gray-700 mb-2">Sasaran Pekerjaan (SKP)</label>
                    <input type="text" name="sasaran_pekerjaan" placeholder="Contoh: Meningkatnya layanan administrasi..." required class="w-full border-gray-300 rounded-lg p-3 focus:ring-2 focus:ring-blue-500 border bg-gray-50">
                </div>
                
                <div class="grid grid-cols-2 gap-6">
                    <div>
                        <label class="block text-sm font-bold text-gray-700 mb-2">Jam Mulai</label>
                        <input type="time" name="jam_mulai" value="07:30" required 
                               class="w-full border-gray-300 rounded-lg p-3 focus:ring-2 focus:ring-blue-500 border bg-gray-50 cursor-pointer"
                               onclick="this.showPicker()">
                    </div>
                    <div>
                        <label class="block text-sm font-bold text-gray-700 mb-2">Jam Selesai</label>
                        <input type="time" name="jam_selesai" value="16:00" required 
                               class="w-full border-gray-300 rounded-lg p-3 focus:ring-2 focus:ring-blue-500 border bg-gray-50 cursor-pointer"
                               onclick="this.showPicker()">
                    </div>
                </div>

                <div>
                    <label class="block text-sm font-bold text-gray-700 mb-2">Uraian Kegiatan</label>
                    <textarea name="kegiatan" rows="4" placeholder="Deskripsikan kegiatan anda..." required class="w-full border-gray-300 rounded-lg p-3 focus:ring-2 focus:ring-blue-500 border bg-gray-50"></textarea>
                </div>

                <div>
                    <label class="block text-sm font-bold text-gray-700 mb-2">Hasil / Output</label>
                    <input type="text" name="output" placeholder="Contoh: Laporan Selesai" required class="w-full border-gray-300 rounded-lg p-3 border bg-gray-50">
                </div>

                <!-- Upload Bukti Foto -->
                <div>
                    <label class="block text-sm font-bold text-gray-700 mb-2">Upload Bukti Foto</label>
                    <div class="border-2 border-dashed border-gray-300 rounded-xl p-8 text-center hover:bg-blue-50 transition cursor-pointer relative bg-gray-50 group">
                        <input type="file" name="bukti_foto" id="fileInput" accept="image/*" class="absolute inset-0 w-full h-full opacity-0 cursor-pointer z-10" onchange="previewFile()">
                        
                        <div id="uploadPlaceholder">
                            <span class="text-3xl">📷</span>
                            <p class="mt-2 text-sm text-gray-500 group-hover:text-blue-600">Klik area ini untuk memilih foto</p>
                        </div>
                        
                        <div id="fileInfo" class="hidden">
                            <span class="text-3xl">✅</span>
                            <p id="fileName" class="mt-2 text-sm font-bold text-green-600"></p>
                            <p class="text-xs text-gray-400">Klik lagi untuk mengganti</p>
                        </div>
                    </div>
                </div>

                <div class="pt-4">
                    <button type="submit" class="w-full bg-blue-600 hover:bg-blue-700 text-white font-bold py-4 rounded-xl shadow-lg transition transform hover:-translate-y-1">
                        Simpan Logbook
                    </button>
                </div>
            </form>
        </div>
    </div>
</div>

<script>
function previewFile() {
    const input = document.getElementById('fileInput');
    const placeholder = document.getElementById('uploadPlaceholder');
    const info = document.getElementById('fileInfo');
    const nameDisplay = document.getElementById('fileName');

    if (input.files && input.files[0]) {
        placeholder.classList.add('hidden');
        info.classList.remove('hidden');
        nameDisplay.textContent = "File Terpilih: " + input.files[0].name;
    }
}
</script>
@endsection