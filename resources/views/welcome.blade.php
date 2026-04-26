<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}" data-theme="light">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>Puzzle PC - Toko Part PC Gaming Terlengkap</title>
    
    <!-- Bootstrap 5 CDN -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    
    <!-- Font Awesome -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">
    
    <!-- Google Fonts -->
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700;800&display=swap" rel="stylesheet">
    
    <style>
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }
        
        :root {
            --bg-primary: #ffffff;
            --bg-secondary: #f8f9fa;
            --text-primary: #1a1a1a;
            --text-secondary: #6c757d;
            --card-bg: #ffffff;
            --border-color: #e0e0e0;
            --neon-cyan: #00e5ff;
            --neon-blue: #2979ff;
            --accent-gradient: linear-gradient(135deg, #2979ff 0%, #00e5ff 100%);
            --shadow-neon: 0 0 15px rgba(41, 121, 255, 0.4), 0 0 5px rgba(0, 229, 255, 0.3);
        }
        
        [data-theme="dark"] {
            --bg-primary: #0a0a0a;
            --bg-secondary: #1a1a1a;
            --text-primary: #ffffff;
            --text-secondary: #a0a0a0;
            --card-bg: #1e1e1e;
            --border-color: #333333;
        }
        
        body {
            background-color: var(--bg-primary);
            color: var(--text-primary);
            font-family: 'Inter', sans-serif;
            transition: all 0.3s ease;
        }
        
        /* SEMUA SUDUT LANCIP! */
        .card, .btn, input, select, textarea, .navbar, .modal-content {
            border-radius: 0px !important;
        }
        
        /* Navbar Gaming */
        .navbar-gaming {
            background: var(--bg-primary);
            border-bottom: 2px solid var(--border-color);
            padding: 15px 0;
        }
        
        .navbar-gaming .nav-link {
            color: var(--text-primary);
            font-weight: 500;
            transition: color 0.3s;
        }
        
        .navbar-gaming .nav-link:hover {
            color: var(--neon-cyan);
        }
        
        /* Neon Button */
        .btn-neon {
            background: var(--accent-gradient);
            border: none;
            color: white;
            font-weight: 600;
            padding: 10px 24px;
            transition: all 0.3s ease;
        }
        
        .btn-neon:hover {
            transform: translateY(-2px);
            box-shadow: var(--shadow-neon);
            color: white;
        }
        
        /* Outline Neon Button */
        .btn-outline-neon {
            background: transparent;
            border: 2px solid var(--neon-cyan);
            color: var(--neon-cyan);
            font-weight: 600;
            transition: all 0.3s ease;
        }
        
        .btn-outline-neon:hover {
            background: var(--accent-gradient);
            border-color: transparent;
            color: white;
            box-shadow: var(--shadow-neon);
        }
        
        /* Hero Section */
        .hero-gaming {
            background: var(--accent-gradient);
            padding: 100px 0;
            position: relative;
            overflow: hidden;
        }
        
        .hero-gaming::before {
            content: '';
            position: absolute;
            top: 0;
            left: 0;
            right: 0;
            bottom: 0;
            background: url('data:image/svg+xml,<svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 100 100" opacity="0.1"><path fill="white" d="M10,10 L90,10 L90,90 L10,90 Z"/><circle cx="50" cy="50" r="10"/></svg>');
            background-repeat: repeat;
        }
        
        /* Feature Card */
        .feature-card {
            background: var(--card-bg);
            border: 1px solid var(--border-color);
            padding: 30px;
            transition: all 0.3s ease;
            height: 100%;
        }
        
        .feature-card:hover {
            transform: translateY(-5px);
            box-shadow: var(--shadow-neon);
            border-color: var(--neon-cyan);
        }
        
        .feature-icon {
            font-size: 48px;
            background: var(--accent-gradient);
            -webkit-background-clip: text;
            background-clip: text;
            color: transparent;
        }
        
        /* Dark Mode Toggle */
        .theme-switch {
            position: relative;
            width: 55px;
            height: 28px;
            display: inline-block;
        }
        
        .theme-switch input {
            opacity: 0;
            width: 0;
            height: 0;
        }
        
        .slider {
            position: absolute;
            cursor: pointer;
            top: 0;
            left: 0;
            right: 0;
            bottom: 0;
            background: var(--border-color);
            transition: 0.3s;
            border-radius: 28px;
        }
        
        .slider:before {
            position: absolute;
            content: "☀️";
            height: 24px;
            width: 24px;
            left: 2px;
            bottom: 2px;
            background: white;
            transition: 0.3s;
            border-radius: 50%;
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 12px;
        }
        
        input:checked + .slider:before {
            transform: translateX(27px);
            content: "🌙";
        }
        
        /* CTA Section */
        .cta-gaming {
            background: var(--bg-secondary);
            border-top: 2px solid var(--border-color);
            border-bottom: 2px solid var(--border-color);
        }
        
        /* Footer */
        .footer-gaming {
            background: var(--bg-secondary);
            border-top: 2px solid var(--border-color);
            padding: 30px 0;
        }
    </style>
</head>
<body>
    <!-- Navbar Gaming -->
    <nav class="navbar navbar-expand-lg navbar-gaming sticky-top">
        <div class="container">
            <a class="navbar-brand fw-bold fs-3" href="{{ url('/') }}" style="background: var(--accent-gradient); -webkit-background-clip: text; background-clip: text; color: transparent;">
                🧩 PUZZLE PC
            </a>
            
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarContent">
                <span class="navbar-toggler-icon"></span>
            </button>
            
            <div class="collapse navbar-collapse" id="navbarContent">
                <ul class="navbar-nav mx-auto mb-2 mb-lg-0">
                    <li class="nav-item">
                        <a class="nav-link" href="{{ url('/') }}">HOME</a>
                    </li>
                    @auth
                        <li class="nav-item">
                            <a class="nav-link" href="{{ route('shop.index') }}">TOKO</a>
                        </li>
                    @endauth
                </ul>
                
                <div class="d-flex gap-3 align-items-center">
                    <!-- Dark Mode Toggle -->
                    <label class="theme-switch">
                        <input type="checkbox" id="theme-toggle">
                        <span class="slider"></span>
                    </label>
                    
                    @auth
                        <div class="dropdown">
                            <button class="btn btn-neon dropdown-toggle" type="button" data-bs-toggle="dropdown">
                                <i class="fas fa-user me-1"></i>{{ Auth::user()->name }}
                            </button>
                            <ul class="dropdown-menu dropdown-menu-end">
                                <li><a class="dropdown-item" href="{{ route('shop.index') }}">🛒 Toko</a></li>
                                <li><a class="dropdown-item" href="{{ route('orders.index') }}">📋 Pesanan</a></li>
                                <li><hr class="dropdown-divider"></li>
                                <li>
                                    <form method="POST" action="{{ route('logout') }}">
                                        @csrf
                                        <button type="submit" class="dropdown-item">🚪 Logout</button>
                                    </form>
                                </li>
                            </ul>
                        </div>
                    @else
                        <a href="{{ route('login') }}" class="btn btn-outline-neon">LOGIN</a>
                        <a href="{{ route('register') }}" class="btn btn-neon">REGISTER</a>
                    @endauth
                </div>
            </div>
        </div>
    </nav>

    <!-- Hero Section Gaming -->
    <div class="hero-gaming">
        <div class="container text-center position-relative" style="z-index: 2;">
            <h1 class="display-3 fw-bold text-white mb-3">
                🧩 PUZZLE PC
            </h1>
            <p class="lead text-white-50 mb-4">
                Tempatnya Part PC Berkualitas untuk Build Impianmu
            </p>
            <div class="d-flex gap-3 justify-content-center">
                @auth
                    <a href="{{ route('shop.index') }}" class="btn btn-outline-neon bg-white text-dark">
                        <i class="fas fa-store me-2"></i>MULAI BELANJA
                    </a>
                @else
                    <a href="{{ route('register') }}" class="btn btn-outline-neon bg-white text-dark">
                        <i class="fas fa-user-plus me-2"></i>DAFTAR SEKARANG
                    </a>
                    <a href="{{ route('login') }}" class="btn btn-neon">
                        <i class="fas fa-sign-in-alt me-2"></i>LOGIN
                    </a>
                @endauth
            </div>
        </div>
    </div>

    <!-- Fitur Unggulan -->
    <div class="container py-5 my-5">
        <h2 class="text-center fw-bold mb-5" style="background: var(--accent-gradient); -webkit-background-clip: text; background-clip: text; color: transparent;">
            WHY CHOOSE PUZZLE PC?
        </h2>
        
        <div class="row g-4">
            <div class="col-md-4">
                <div class="feature-card text-center">
                    <i class="fas fa-microchip feature-icon mb-3"></i>
                    <h4 class="fw-bold mb-2">Part PC Original</h4>
                    <p class="text-secondary">Semua produk 100% original dengan garansi resmi</p>
                </div>
            </div>
            <div class="col-md-4">
                <div class="feature-card text-center">
                    <i class="fas fa-tag feature-icon mb-3"></i>
                    <h4 class="fw-bold mb-2">Harga Terjangkau</h4>
                    <p class="text-secondary">Harga kompetitif dengan promo menarik setiap bulan</p>
                </div>
            </div>
            <div class="col-md-4">
                <div class="feature-card text-center">
                    <i class="fas fa-shipping-fast feature-icon mb-3"></i>
                    <h4 class="fw-bold mb-2">Pengiriman Cepat</h4>
                    <p class="text-secondary">Pengiriman ke seluruh Indonesia dengan packing aman</p>
                </div>
            </div>
        </div>
    </div>

    <!-- CTA Section -->
    <div class="cta-gaming py-5 my-5">
        <div class="container text-center">
            <h2 class="fw-bold mb-3">Siap Merakit PC Impian?</h2>
            <p class="text-secondary mb-4">Daftar sekarang dan temukan part PC terbaik untuk build-mu</p>
            @guest
                <a href="{{ route('register') }}" class="btn btn-neon btn-lg">
                    <i class="fas fa-user-plus me-2"></i>DAFTAR SEKARANG
                </a>
            @endguest
            @auth
                <a href="{{ route('shop.index') }}" class="btn btn-neon btn-lg">
                    <i class="fas fa-store me-2"></i>MULAI BELANJA
                </a>
            @endauth
        </div>
    </div>

    <!-- Footer Gaming -->
    <footer class="footer-gaming">
        <div class="container text-center">
            <p class="mb-0">&copy; {{ date('Y') }} Puzzle PC - Toko Part PC Gaming</p>
            <small class="text-secondary">Powered by NVIDIA | AMD | INTEL</small>
        </div>
    </footer>

    <!-- Scripts -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
    
    <script>
        // Dark Mode Toggle
        const themeToggle = document.getElementById('theme-toggle');
        if (themeToggle) {
            const savedTheme = localStorage.getItem('theme');
            if (savedTheme === 'dark') {
                document.documentElement.setAttribute('data-theme', 'dark');
                themeToggle.checked = true;
            }
            
            themeToggle.addEventListener('change', function() {
                if (this.checked) {
                    document.documentElement.setAttribute('data-theme', 'dark');
                    localStorage.setItem('theme', 'dark');
                } else {
                    document.documentElement.removeAttribute('data-theme');
                    localStorage.setItem('theme', 'light');
                }
            });
        }
    </script>
</body>
</html>