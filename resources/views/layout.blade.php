<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>E-Logbook PPPK</title>
    <!-- Tailwind CSS CDN -->
    <script src="https://cdn.tailwindcss.com"></script>
    <!-- Tailwind Configuration untuk gradasi -->
    <script>
        tailwind.config = {
            theme: {
                extend: {
                    colors: {
                        'primary': {
                            50: '#eff6ff',
                            100: '#dbeafe',
                            200: '#bfdbfe',
                            300: '#93c5fd',
                            400: '#60a5fa',
                            500: '#3b82f6',
                            600: '#2563eb',
                            700: '#1d4ed8',
                            800: '#1e40af',
                            900: '#1e3a8a',
                        },
                        'secondary': {
                            50: '#f0f9ff',
                            100: '#e0f2fe',
                            200: '#bae6fd',
                            300: '#7dd3fc',
                            400: '#38bdf8',
                            500: '#0ea5e9',
                            600: '#0284c7',
                            700: '#0369a1',
                            800: '#075985',
                            900: '#0c4a6e',
                        }
                    },
                    backgroundImage: {
                        'gradient-radial': 'radial-gradient(var(--tw-gradient-stops))',
                        'gradient-conic': 'conic-gradient(from 180deg at 50% 50%, var(--tw-gradient-stops))',
                    }
                }
            }
        }
    </script>
    <!-- Font Awesome untuk icon -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700;800&display=swap" rel="stylesheet">
    <style>
        body { 
            font-family: 'Inter', sans-serif;
            background: linear-gradient(135deg, #f0f9ff 0%, #e0f2fe 25%, #bfdbfe 50%, #93c5fd 75%, #60a5fa 100%);
            min-height: 100vh;
        }
        
        .nav-gradient {
            background: linear-gradient(90deg, #1e3a8a 0%, #1d4ed8 50%, #2563eb 100%);
        }
        
        .card-gradient {
            background: linear-gradient(145deg, #ffffff 0%, #f8fafc 100%);
            border: 1px solid rgba(59, 130, 246, 0.2);
        }
        
        .btn-primary {
            background: linear-gradient(90deg, #2563eb 0%, #3b82f6 100%);
            transition: all 0.3s ease;
        }
        
        .btn-primary:hover {
            background: linear-gradient(90deg, #1d4ed8 0%, #2563eb 100%);
            transform: translateY(-2px);
            box-shadow: 0 10px 25px -5px rgba(37, 99, 235, 0.4);
        }
        
        .glass-effect {
            background: rgba(255, 255, 255, 0.1);
            backdrop-filter: blur(10px);
            border: 1px solid rgba(255, 255, 255, 0.2);
        }
        
        .gradient-text {
            background: linear-gradient(90deg, #2563eb 0%, #7c3aed 100%);
            -webkit-background-clip: text;
            -webkit-text-fill-color: transparent;
            background-clip: text;
        }
        
        .floating-animation {
            animation: floating 3s ease-in-out infinite;
        }
        
        @keyframes floating {
            0%, 100% { transform: translateY(0px); }
            50% { transform: translateY(-10px); }
        }
        
        .pulse-animation {
            animation: pulse 2s cubic-bezier(0.4, 0, 0.6, 1) infinite;
        }
        
        @keyframes pulse {
            0%, 100% { opacity: 1; }
            50% { opacity: 0.7; }
        }
        
        /* Custom Scrollbar */
        ::-webkit-scrollbar {
            width: 8px;
        }
        
        ::-webkit-scrollbar-track {
            background: #f1f1f1;
            border-radius: 10px;
        }
        
        ::-webkit-scrollbar-thumb {
            background: linear-gradient(180deg, #3b82f6, #1d4ed8);
            border-radius: 10px;
        }
        
        ::-webkit-scrollbar-thumb:hover {
            background: linear-gradient(180deg, #2563eb, #1e40af);
        }
    </style>
</head>
<body class="text-gray-800">
    @auth
    <!-- Navigation Bar -->
    <nav class="nav-gradient text-white shadow-2xl sticky top-0 z-50">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="flex items-center justify-between h-16">
                <!-- Logo/Brand -->
                <div class="flex items-center space-x-3">
                    <div class="relative">
                        <div class="w-10 h-10 bg-gradient-to-br from-cyan-400 to-blue-600 rounded-xl flex items-center justify-center shadow-lg floating-animation">
                            <i class="fas fa-book text-white text-lg"></i>
                        </div>
                        <div class="absolute -top-1 -right-1 w-4 h-4 bg-yellow-400 rounded-full pulse-animation"></div>
                    </div>
                    <div>
                        <h1 class="font-bold text-xl tracking-tight">E-Logbook <span class="text-cyan-300">P3K</span></h1>
                        <p class="text-xs text-blue-200 opacity-90">Digital Activity Tracker</p>
                    </div>
                </div>

                <!-- User Info & Actions -->
                <div class="flex items-center gap-4">
                    <!-- User Profile Card -->
                    <div class="hidden md:flex items-center space-x-3 bg-blue-800/30 px-4 py-2 rounded-xl glass-effect">
                        <div class="w-8 h-8 bg-gradient-to-br from-blue-400 to-cyan-300 rounded-full flex items-center justify-center">
                            <i class="fas fa-user text-white text-sm"></i>
                        </div>
                        <div class="text-right">
                            <span class="text-sm font-semibold block">{{ Auth::user()->name }}</span>
                            <span class="text-xs text-blue-200 flex items-center gap-1">
                                <i class="fas fa-badge-check text-xs"></i>
                                {{ str_contains(Auth::user()->email, 'admin') ? 'Administrator' : 'Pegawai' }}
                            </span>
                        </div>
                    </div>
                    
                    <!-- Quick Actions -->
                    <div class="flex items-center gap-2">
                        <a href="{{ route('dashboard') }}" 
                           class="hidden sm:flex items-center gap-2 px-4 py-2 bg-blue-700/50 hover:bg-blue-600/70 rounded-lg transition-all duration-300 group">
                            <i class="fas fa-home text-blue-200 group-hover:text-white"></i>
                            <span class="text-sm">Dashboard</span>
                        </a>
                        
                        <!-- Logout Button -->
                        <form action="{{ route('logout') }}" method="POST">
                            @csrf
                            <button type="submit" 
                                    class="flex items-center gap-2 bg-gradient-to-r from-red-500 to-pink-600 hover:from-red-600 hover:to-pink-700 
                                           text-white px-4 py-2 rounded-lg text-sm font-medium shadow-lg transition-all duration-300 
                                           hover:shadow-xl hover:scale-105 active:scale-95">
                                <i class="fas fa-sign-out-alt"></i>
                                <span class="hidden sm:inline">Keluar</span>
                            </button>
                        </form>
                    </div>
                </div>
            </div>
            
            <!-- Mobile Navigation -->
            <div class="md:hidden bg-blue-800/40 py-3 px-4 rounded-b-lg">
                <div class="flex items-center justify-between">
                    <div class="flex items-center space-x-2">
                        <div class="w-8 h-8 bg-gradient-to-r from-blue-400 to-cyan-300 rounded-full flex items-center justify-center">
                            <span class="text-white text-sm font-bold">{{ substr(Auth::user()->name, 0, 1) }}</span>
                        </div>
                        <span class="text-sm font-medium">{{ Auth::user()->name }}</span>
                    </div>
                    <a href="{{ route('dashboard') }}" class="text-blue-200 hover:text-white">
                        <i class="fas fa-home text-lg"></i>
                    </a>
                </div>
            </div>
        </div>
    </nav>
    @endauth

    <!-- Main Content -->
    <main class="py-6 px-4 sm:px-6 lg:px-8 min-h-screen">
        <!-- Background decorative elements -->
        <div class="fixed top-0 left-0 w-full h-full -z-10 overflow-hidden">
            <div class="absolute top-10 right-10 w-72 h-72 bg-blue-300 rounded-full mix-blend-multiply filter blur-3xl opacity-20 animate-pulse"></div>
            <div class="absolute bottom-10 left-10 w-72 h-72 bg-cyan-300 rounded-full mix-blend-multiply filter blur-3xl opacity-20 animate-pulse delay-1000"></div>
            <div class="absolute top-1/2 left-1/2 transform -translate-x-1/2 -translate-y-1/2 w-96 h-96 bg-purple-300 rounded-full mix-blend-multiply filter blur-3xl opacity-10 animate-pulse delay-500"></div>
        </div>
        
        @yield('content')
    </main>
    
    <!-- Footer -->
    <footer class="mt-12">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            
            <!-- Footer Content -->
            <div class="bg-gradient-to-b from-blue-800 to-blue-900 text-white py-8 px-6 rounded-t-3xl shadow-2xl">
                <div class="grid grid-cols-1 md:grid-cols-3 gap-8">
                    <!-- Company Info -->
                    <div class="space-y-4">
                        <div class="flex items-center space-x-3">
                            <div class="w-10 h-10 bg-gradient-to-br from-cyan-400 to-blue-500 rounded-xl flex items-center justify-center">
                                <i class="fas fa-book text-white"></i>
                            </div>
                            <div>
                                <h3 class="font-bold text-lg">E-Logbook P3K</h3>
                                <p class="text-blue-200 text-sm">Sistem Pelaporan Digital</p>
                            </div>
                        </div>
                        <p class="text-blue-300 text-sm">
                            Platform digital untuk pencatatan dan monitoring kegiatan harian pegawai secara real-time.
                        </p>
                    </div>
                    
                    <!-- Quick Links -->
                    <div class="space-y-4">
                        <h4 class="font-bold text-lg border-l-4 border-cyan-400 pl-3">Navigasi Cepat</h4>
                        <ul class="space-y-2">
                            <li>
                                <a href="{{ route('dashboard') }}" class="flex items-center gap-2 text-blue-200 hover:text-white transition-colors">
                                    <i class="fas fa-arrow-right text-xs"></i>
                                    <span>Dashboard Utama</span>
                                </a>
                            </li>
                            <li>
                                <a href="{{ route('logbook.create') }}" class="flex items-center gap-2 text-blue-200 hover:text-white transition-colors">
                                    <i class="fas fa-arrow-right text-xs"></i>
                                    <span>Input Kegiatan</span>
                                </a>
                            </li>
                            <li>
                                <a href="{{ route('logbook.history') }}" class="flex items-center gap-2 text-blue-200 hover:text-white transition-colors">
                                    <i class="fas fa-arrow-right text-xs"></i>
                                    <span>Riwayat Laporan</span>
                                </a>
                            </li>
                        </ul>
                    </div>
                    
                    <!-- Contact/Info -->
                    <div class="space-y-4">
                        <h4 class="font-bold text-lg border-l-4 border-cyan-400 pl-3">Kontak & Support</h4>
                        <div class="space-y-3">
                            <div class="flex items-center gap-3">
                                <div class="w-8 h-8 bg-blue-700 rounded-full flex items-center justify-center">
                                    <i class="fas fa-headset text-cyan-300"></i>
                                </div>
                                <span class="text-sm text-blue-200">Support: help@elogbook.id</span>
                            </div>
                            <div class="flex items-center gap-3">
                                <div class="w-8 h-8 bg-blue-700 rounded-full flex items-center justify-center">
                                    <i class="fas fa-shield-alt text-cyan-300"></i>
                                </div>
                                <span class="text-sm text-blue-200">Sistem Terenkripsi & Aman</span>
                            </div>
                        </div>
                    </div>
                </div>
                
                <!-- Copyright -->
                <div class="mt-8 pt-6 border-t border-blue-700/50 text-center">
                    <p class="text-blue-300 text-sm">
                        &copy; {{ date('Y') }} <span class="font-semibold text-cyan-300">Sistem Informasi BPMP</span>. 
                        Hak Cipta Dilindungi.
                    </p>
                    <p class="text-blue-400 text-xs mt-2">
                        <i class="fas fa-heart text-red-400"></i> 
                        Dibangun dengan teknologi terkini untuk pelayanan terbaik
                    </p>
                </div>
            </div>
        </div>
    </footer>

    <!-- Optional JavaScript for interactive elements -->
    <script>
        // Smooth scroll untuk anchor links
        document.querySelectorAll('a[href^="#"]').forEach(anchor => {
            anchor.addEventListener('click', function (e) {
                e.preventDefault();
                const target = document.querySelector(this.getAttribute('href'));
                if (target) {
                    target.scrollIntoView({
                        behavior: 'smooth',
                        block: 'start'
                    });
                }
            });
        });

        // Toast notification handler
        document.addEventListener('DOMContentLoaded', function() {
            // Check for success/error messages
            const successMessage = "{{ session('success') }}";
            const errorMessage = "{{ session('error') }}";
            
            if (successMessage) {
                showToast(successMessage, 'success');
            }
            if (errorMessage) {
                showToast(errorMessage, 'error');
            }
        });

        function showToast(message, type = 'info') {
            const toast = document.createElement('div');
            toast.className = `fixed top-5 right-5 z-50 px-6 py-4 rounded-xl shadow-2xl transform transition-all duration-500 ${
                type === 'success' 
                    ? 'bg-gradient-to-r from-green-500 to-emerald-600 text-white' 
                    : 'bg-gradient-to-r from-red-500 to-pink-600 text-white'
            }`;
            toast.innerHTML = `
                <div class="flex items-center gap-3">
                    <i class="fas ${type === 'success' ? 'fa-check-circle' : 'fa-exclamation-circle'} text-xl"></i>
                    <div>
                        <p class="font-semibold">${type === 'success' ? 'Sukses!' : 'Perhatian!'}</p>
                        <p class="text-sm">${message}</p>
                    </div>
                    <button onclick="this.parentElement.parentElement.remove()" class="ml-4 text-white/80 hover:text-white">
                        <i class="fas fa-times"></i>
                    </button>
                </div>
            `;
            document.body.appendChild(toast);
            
            // Auto remove after 5 seconds
            setTimeout(() => {
                if (toast.parentElement) {
                    toast.style.opacity = '0';
                    toast.style.transform = 'translateX(100%)';
                    setTimeout(() => toast.remove(), 300);
                }
            }, 5000);
        }
    </script>
</body>
</html>