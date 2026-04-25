<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>Login - Puzzle PC</title>
    
    <!-- Tailwind CSS & Font Awesome -->
    <script src="https://cdn.tailwindcss.com"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">
</head>
<body class="bg-gradient-to-r from-blue-600 to-indigo-700">
    <div class="min-h-screen flex items-center justify-center py-12 px-4 sm:px-6 lg:px-8">
        <div class="max-w-md w-full bg-white rounded-lg shadow-xl overflow-hidden">
            <!-- Header -->
            <div class="bg-gradient-to-r from-blue-600 to-indigo-700 px-6 py-8 text-center">
                <i class="fas fa-microchip text-white text-5xl mb-3"></i>
                <h2 class="text-3xl font-bold text-white">Puzzle PC</h2>
                <p class="text-blue-100 mt-2">Login untuk berbelanja</p>
            </div>

            <!-- Form Login -->
            <div class="px-6 py-8">
                <!-- Session Status -->
                @if (session('status'))
                    <div class="mb-4 text-sm text-green-600">
                        {{ session('status') }}
                    </div>
                @endif

                <form method="POST" action="{{ route('login') }}">
                    @csrf

                    <!-- Email Address -->
                    <div class="mb-4">
                        <label for="email" class="block text-gray-700 font-bold mb-2">
                            <i class="fas fa-envelope mr-2"></i> Alamat Email
                        </label>
                        <input id="email" type="email" name="email" value="{{ old('email') }}" required autofocus
                               class="w-full px-4 py-2 border rounded-lg focus:outline-none focus:border-blue-500 @error('email') border-red-500 @enderror"
                               placeholder="contoh@email.com">
                        @error('email')
                            <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                        @enderror
                    </div>

                    <!-- Password -->
                    <div class="mb-4">
                        <label for="password" class="block text-gray-700 font-bold mb-2">
                            <i class="fas fa-lock mr-2"></i> Password
                        </label>
                        <input id="password" type="password" name="password" required
                               class="w-full px-4 py-2 border rounded-lg focus:outline-none focus:border-blue-500 @error('password') border-red-500 @enderror"
                               placeholder="Masukkan password">
                        @error('password')
                            <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                        @enderror
                    </div>

                    <!-- Remember Me -->
                    <div class="flex items-center justify-between mb-6">
                        <label class="flex items-center">
                            <input type="checkbox" name="remember" class="rounded border-gray-300 text-blue-600">
                            <span class="ml-2 text-sm text-gray-600">Ingat Saya</span>
                        </label>
                        @if (Route::has('password.request'))
                            <a href="{{ route('password.request') }}" class="text-sm text-blue-600 hover:text-blue-800">
                                Lupa Password?
                            </a>
                        @endif
                    </div>

                    <!-- Submit Button -->
                    <button type="submit" class="w-full bg-gradient-to-r from-blue-600 to-indigo-700 text-white py-3 rounded-lg font-bold hover:from-blue-700 hover:to-indigo-800 transition">
                        <i class="fas fa-sign-in-alt mr-2"></i> Login
                    </button>
                </form>

                <!-- Link Register -->
                <div class="text-center mt-6">
                    <p class="text-gray-600">
                        Belum punya akun?
                        <a href="{{ route('register') }}" class="text-blue-600 hover:text-blue-800 font-semibold">
                            Daftar Sekarang
                        </a>
                    </p>
                </div>
            </div>
        </div>
    </div>
</body>
</html>