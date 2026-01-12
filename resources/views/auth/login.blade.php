@extends('layout')

@section('content')
<div class="min-h-[70vh] flex flex-col justify-center items-center px-4">
    <div class="bg-white p-8 rounded-2xl shadow-xl w-full max-w-md border border-gray-100">
        <div class="text-center mb-8">
            <div class="inline-block bg-blue-50 p-3 rounded-full mb-3">
                <span class="text-4xl">🔐</span>
            </div>
            <h2 class="text-2xl font-bold text-blue-900">Login E-Logbook</h2>
            <p class="text-gray-500 text-sm mt-1">Masuk untuk mengisi laporan kinerja harian</p>
        </div>

        @if(session('success'))
            <div class="bg-green-100 border border-green-200 text-green-700 p-3 rounded-lg mb-4 text-sm text-center font-medium">
                {{ session('success') }}
            </div>
        @endif

        <form action="{{ route('login') }}" method="POST" class="space-y-5">
            @csrf
            <div>
                <label class="block text-sm font-semibold text-gray-700 mb-1">Email Dinas / Pribadi</label>
                <input type="email" name="email" required class="w-full px-4 py-2.5 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-blue-500 focus:outline-none transition" placeholder="nama@email.com">
                @error('email') <span class="text-red-500 text-xs mt-1 block">{{ $message }}</span> @enderror
            </div>
            
            <div>
                <label class="block text-sm font-semibold text-gray-700 mb-1">Password</label>
                <input type="password" name="password" required class="w-full px-4 py-2.5 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-blue-500 focus:outline-none transition" placeholder="••••••••">
            </div>

            <button type="submit" class="w-full bg-blue-600 hover:bg-blue-700 text-white font-bold py-3 rounded-lg transition shadow-lg hover:shadow-xl transform hover:-translate-y-0.5">
                Masuk Aplikasi
            </button>
        </form>

        <div class="mt-6 text-center pt-6 border-t border-gray-100">
            <p class="text-sm text-gray-600">
                Belum punya akun? <a href="{{ route('register') }}" class="text-blue-600 font-bold hover:underline">Daftar disini</a>
            </p>
        </div>
    </div>
</div>
@endsection