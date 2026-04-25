<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>Puzzle PC - Toko Part PC Terpercaya</title>
    
    <!-- Tailwind CSS & Font Awesome -->
    <script src="https://cdn.tailwindcss.com"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">
</head>
<body class="bg-gray-100">
    <!-- Navbar Sederhana -->
    <nav class="bg-white shadow-md">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="flex justify-between h-16">
                <div class="flex items-center">
                    <a href="{{ url('/') }}" class="text-xl font-bold text-gray-800">
                        🧩 Puzzle PC
                    </a>
                </div>
                <div class="flex items-center space-x-4">
                    @if (Route::has('login'))
                        @auth
                            <a href="{{ url('/shop') }}" class="text-gray-700 hover:text-blue-600">Toko</a>
                            <a href="{{ url('/dashboard') }}" class="bg-blue-600 text-white px-4 py-2 rounded-lg hover:bg-blue-700">
                                Dashboard
                            </a>
                        @else
                            <a href="{{ route('login') }}" class="text-gray-700 hover:text-blue-600">Login</a>
                            <a href="{{ route('register') }}" class="bg-blue-600 text-white px-4 py-2 rounded-lg hover:bg-blue-700">
                                Register
                            </a>
                        @endauth
                    @endif
                </div>
            </div>
        </div>
    </nav>

    <!-- Hero Section -->
    <div class="relative bg-gradient-to-r from-blue-600 to-indigo-700 text-white">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-24">
            <div class="text-center">
                <h1 class="text-4xl md:text-6xl font-bold mb-4">
                    🧩 Puzzle PC
                </h1>
                <p class="text-xl md:text-2xl mb-8">
                    Tempatnya Part PC Berkualitas untuk Build Impianmu
                </p>
                <div class="flex justify-center gap-4">
                    <a href="{{ route('register') }}" 
                       class="bg-white text-blue-600 px-6 py-3 rounded-lg font-semibold hover:bg-gray-100">
                        Mulai Belanja
                    </a>
                    <a href="{{ route('login') }}" 
                       class="border-2 border-white text-white px-6 py-3 rounded-lg font-semibold hover:bg-white hover:text-blue-600">
                        Login
                    </a>
                </div>
            </div>
        </div>
    </div>

    <!-- Fitur Unggulan -->
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-16">
        <h2 class="text-3xl font-bold text-center text-gray-800 mb-12">
            Kenapa Belanja di Puzzle PC?
        </h2>
        <div class="grid grid-cols-1 md:grid-cols-3 gap-8">
            <div class="text-center p-6 bg-white rounded-lg shadow-md">
                <i class="fas fa-microchip text-4xl text-blue-600 mb-4"></i>
                <h3 class="text-xl font-bold mb-2">Part PC Original</h3>
                <p class="text-gray-600">Semua produk 100% original dengan garansi resmi</p>
            </div>
            <div class="text-center p-6 bg-white rounded-lg shadow-md">
                <i class="fas fa-tag text-4xl text-blue-600 mb-4"></i>
                <h3 class="text-xl font-bold mb-2">Harga Terjangkau</h3>
                <p class="text-gray-600">Harga kompetitif dengan promo menarik setiap bulan</p>
            </div>
            <div class="text-center p-6 bg-white rounded-lg shadow-md">
                <i class="fas fa-shipping-fast text-4xl text-blue-600 mb-4"></i>
                <h3 class="text-xl font-bold mb-2">Pengiriman Cepat</h3>
                <p class="text-gray-600">Pengiriman ke seluruh Indonesia dengan packing aman</p>
            </div>
        </div>
    </div>

    <!-- CTA untuk Daftar -->
    <div class="bg-gray-800 text-white py-16">
        <div class="max-w-7xl mx-auto px-4 text-center">
            <h2 class="text-3xl font-bold mb-4">Siap Merakit PC Impian?</h2>
            <p class="text-gray-400 mb-8">Daftar sekarang dan temukan part PC terbaik untuk build-mu</p>
            <a href="{{ route('register') }}" class="bg-blue-600 px-6 py-3 rounded-lg font-semibold hover:bg-blue-700">
                Daftar Sekarang
            </a>
        </div>
    </div>

    <!-- Footer -->
    <footer class="bg-gray-900 text-gray-400 py-8">
        <div class="max-w-7xl mx-auto px-4 text-center">
            <p>&copy; {{ date('Y') }} Puzzle PC - Toko Part PC. All rights reserved.</p>
        </div>
    </footer>
</body>
</html>