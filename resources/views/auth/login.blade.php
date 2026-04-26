@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center align-items-center min-vh-100">
        <div class="col-md-6 col-lg-5">
            <div class="product-card p-4 p-lg-5">
                <!-- Header -->
                <div class="text-center mb-4">
                    <div class="mb-3">
                        <i class="fas fa-microchip display-1" style="background: var(--accent-gradient); background-clip: text; -webkit-background-clip: text; color: transparent;"></i>
                    </div>
                    <h2 class="fw-bold" style="background: var(--accent-gradient); background-clip: text; -webkit-background-clip: text; color: transparent;">
                        WELCOME BACK
                    </h2>
                    <p class="text-secondary">Login untuk akses toko gaming Anda</p>
                </div>

                <!-- Session Status -->
                @if (session('status'))
                    <div class="alert alert-success mb-4">
                        {{ session('status') }}
                    </div>
                @endif

                <!-- Form Login -->
                <form method="POST" action="{{ route('login') }}">
                    @csrf

                    <!-- Email Address -->
                    <div class="mb-4">
                        <label for="email" class="form-label fw-semibold">
                            <i class="fas fa-envelope me-2"></i>Email Address
                        </label>
                        <input id="email" type="email" name="email" value="{{ old('email') }}" required autofocus
                               class="form-control @error('email') is-invalid @enderror"
                               placeholder="gamer@puzzlepc.com">
                        @error('email')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>

                    <!-- Password -->
                    <div class="mb-4">
                        <label for="password" class="form-label fw-semibold">
                            <i class="fas fa-lock me-2"></i>Password
                        </label>
                        <input id="password" type="password" name="password" required
                               class="form-control @error('password') is-invalid @enderror"
                               placeholder="••••••••">
                        @error('password')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>

                    <!-- Remember Me & Forgot Password -->
                    <div class="d-flex justify-content-between align-items-center mb-4">
                        <div class="form-check">
                            <input type="checkbox" name="remember" class="form-check-input" id="remember">
                            <label class="form-check-label text-secondary" for="remember">
                                Remember Me
                            </label>
                        </div>
                        @if (Route::has('password.request'))
                            <a href="{{ route('password.request') }}" class="text-decoration-none" style="color: var(--neon-cyan);">
                                <i class="fas fa-key me-1"></i>Forgot Password?
                            </a>
                        @endif
                    </div>

                    <!-- Submit Button -->
                    <button type="submit" class="btn btn-neon w-100 py-2">
                        <i class="fas fa-sign-in-alt me-2"></i>LOGIN
                    </button>
                </form>

                <!-- Link Register -->
                <div class="text-center mt-4 pt-3 border-top" style="border-color: var(--border-color) !important;">
                    <p class="text-secondary mb-0">
                        Don't have an account?
                        <a href="{{ route('register') }}" class="fw-semibold text-decoration-none" style="color: var(--neon-cyan);">
                            Register Now <i class="fas fa-arrow-right ms-1"></i>
                        </a>
                    </p>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection