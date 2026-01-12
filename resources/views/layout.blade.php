<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>E-Logbook PPPK</title>
    <!-- Tailwind CSS CDN -->
    <script src="https://cdn.tailwindcss.com"></script>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;600;700&display=swap" rel="stylesheet">
    <style>body { font-family: 'Inter', sans-serif; }</style>
</head>
<body class="bg-gray-50 text-gray-800">
    @auth
    <nav class="bg-blue-900 text-white shadow-lg sticky top-0 z-50">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="flex items-center justify-between h-16">
                <div class="flex items-center font-bold text-xl gap-2">
                    <div class="bg-yellow-400 p-1 rounded">📝</div> 
                    <span>E-Logbook P3K</span>
                </div>
                <div class="flex items-center gap-4">
                    <div class="text-right hidden sm:block">
                        <span class="text-sm font-semibold block">{{ Auth::user()->name }}</span>
                        <span class="text-xs text-blue-200 block">Pegawai</span>
                    </div>
                    <form action="{{ route('logout') }}" method="POST">
                        @csrf
                        <button type="submit" class="bg-red-600 hover:bg-red-700 text-white px-4 py-2 rounded-lg text-sm transition font-medium shadow-md">
                            Keluar
                        </button>
                    </form>
                </div>
            </div>
        </div>
    </nav>
    @endauth

    <main class="py-8 min-h-screen">
        @yield('content')
    </main>
    
    <footer class="bg-white border-t border-gray-200 py-6 mt-8">
        <div class="max-w-7xl mx-auto text-center text-sm text-gray-500">
            &copy; {{ date('Y') }} Sistem Informasi BPMP. All rights reserved.
        </div>
    </footer>
</body>
</html>