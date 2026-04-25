<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>Puzzle PC - {{ $title ?? 'Toko Part PC' }}</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">
</head>
<body class="bg-gray-100">
    <div class="min-h-screen">
        <!-- Navigation -->
        <nav class="bg-white shadow-lg">
            <div class="max-w-7xl mx-auto px-4">
                <div class="flex justify-between h-16">
                    <div class="flex items-center">
                        <a href="{{ url('/') }}" class="text-xl font-bold text-gray-800">
                            🧩 Puzzle PC
                        </a>
                        <div class="hidden md:flex ml-10 space-x-4">
                            <a href="{{ route('shop.index') }}" class="text-gray-700 hover:text-blue-600 px-3 py-2">
                                <i class="fas fa-store"></i> Toko
                            </a>
                        </div>
                    </div>
                    
                    <div class="flex items-center space-x-4">
                        @auth
                            <a href="{{ route('cart.index') }}" class="text-gray-700 hover:text-blue-600">
                                <i class="fas fa-shopping-cart"></i>
                                <span class="text-sm">Keranjang</span>
                            </a>
                            <a href="{{ route('orders.index') }}" class="text-gray-700 hover:text-blue-600">
                                <i class="fas fa-history"></i> Pesanan
                            </a>
                            @if(auth()->user()->role === 'admin')
                                <a href="{{ route('admin.products.index') }}" class="text-gray-700 hover:text-blue-600">
                                    <i class="fas fa-tachometer-alt"></i> Admin
                                </a>
                            @endif
                            <div class="relative">
                                <button onclick="toggleDropdown()" class="flex items-center space-x-2">
                                    <span>{{ Auth::user()->name }}</span>
                                    <i class="fas fa-chevron-down text-sm"></i>
                                </button>
                                <div id="dropdown" class="hidden absolute right-0 mt-2 w-48 bg-white rounded-md shadow-lg py-1 z-20">
                                    <form method="POST" action="{{ route('logout') }}">
                                        @csrf
                                        <button type="submit" class="block w-full text-left px-4 py-2 text-gray-700 hover:bg-gray-100">
                                            <i class="fas fa-sign-out-alt"></i> Logout
                                        </button>
                                    </form>
                                </div>
                            </div>
                        @else
                            <a href="{{ route('login') }}" class="text-gray-700 hover:text-blue-600">Login</a>
                            <a href="{{ route('register') }}" class="bg-blue-600 text-white px-4 py-2 rounded-lg hover:bg-blue-700">
                                Register
                            </a>
                        @endauth
                    </div>
                </div>
            </div>
        </nav>

        <!-- Main Content -->
        <main>
            @yield('content')
        </main>

        <!-- Footer -->
        <footer class="bg-gray-800 text-white mt-12 py-6">
            <div class="max-w-7xl mx-auto px-4 text-center">
                <p>&copy; {{ date('Y') }} Puzzle PC - Jualan Part PC</p>
            </div>
        </footer>
    </div>

    <script>
        function toggleDropdown() {
            const dropdown = document.getElementById('dropdown');
            dropdown.classList.toggle('hidden');
        }
    </script>
    @stack('scripts')
</body>
</html>