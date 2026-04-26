@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center align-items-center min-vh-100">
        <div class="col-md-6 col-lg-5">
            <div class="product-card p-4 p-lg-5">
                <!-- Header -->
                <div class="text-center mb-4">
                    <div class="mb-3">
                        <i class="fas fa-user-plus display-1" style="background: var(--accent-gradient); background-clip: text; -webkit-background-clip: text; color: transparent;"></i>
                    </div>
                    <h2 class="fw-bold" style="background: var(--accent-gradient); background-clip: text; -webkit-background-clip: text; color: transparent;">
                        JOIN THE GRID
                    </h2>
                    <p class="text-secondary">Daftar dan mulai berbelanja part PC</p>
                </div>

                <!-- Form Register -->
                <form method="POST" action="{{ route('register') }}">
                    @csrf

                    <!-- Name -->
                    <div class="mb-3">
                        <label for="name" class="form-label fw-semibold">
                            <i class="fas fa-user me-2"></i>Full Name
                        </label>
                        <input id="name" type="text" name="name" value="{{ old('name') }}" required autofocus
                               class="form-control @error('name') is-invalid @enderror"
                               placeholder="Gamer Name">
                        @error('name')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>

                    <!-- Email Address -->
                    <div class="mb-3">
                        <label for="email" class="form-label fw-semibold">
                            <i class="fas fa-envelope me-2"></i>Email Address
                        </label>
                        <input id="email" type="email" name="email" value="{{ old('email') }}" required
                               class="form-control @error('email') is-invalid @enderror"
                               placeholder="gamer@puzzlepc.com">
                        @error('email')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>

                    <!-- Password -->
                    <div class="mb-3">
                        <label for="password" class="form-label fw-semibold">
                            <i class="fas fa-lock me-2"></i>Password
                        </label>
                        <input id="password" type="password" name="password" required
                               class="form-control @error('password') is-invalid @enderror"
                               placeholder="Minimal 8 karakter">
                        <small class="text-secondary">Password minimal 8 karakter</small>
                        @error('password')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>

                    <!-- Confirm Password -->
                    <div class="mb-4">
                        <label for="password_confirmation" class="form-label fw-semibold">
                            <i class="fas fa-check-circle me-2"></i>Confirm Password
                        </label>
                        <input id="password_confirmation" type="password" name="password_confirmation" required
                               class="form-control"
                               placeholder="Ulangi password">
                    </div>

                    <!-- Submit Button -->
                    <button type="submit" class="btn btn-neon w-100 py-2">
                        <i class="fas fa-user-plus me-2"></i>REGISTER
                    </button>
                </form>

                <!-- Link Login -->
                <div class="text-center mt-4 pt-3 border-top" style="border-color: var(--border-color) !important;">
                    <p class="text-secondary mb-0">
                        Already have an account?
                        <a href="{{ route('login') }}" class="fw-semibold text-decoration-none" style="color: var(--neon-cyan);">
                            Login Now <i class="fas fa-arrow-right ms-1"></i>
                        </a>
                    </p>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection