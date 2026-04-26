<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>Puzzle PC - {{ $title ?? 'Toko Part PC' }}</title>
    
    <!-- Bootstrap 5 CDN -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    
    <!-- Font Awesome -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">
    
    <!-- Google Fonts -->
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700;800&display=swap" rel="stylesheet">
    
    <style>
        /* ========== RESET & BASE ========== */
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
            --border-color: #dee2e6;
            --neon-cyan: #00e5ff;
            --neon-blue: #2979ff;
            --accent-gradient: linear-gradient(135deg, #2979ff 0%, #00e5ff 100%);
            --shadow-neon: 0 0 10px rgba(41, 121, 255, 0.4), 0 0 5px rgba(0, 229, 255, 0.3);
        }
        
        body {
            background-color: var(--bg-primary);
            color: var(--text-primary);
            font-family: 'Inter', sans-serif;
        }
        
        /* ========== SEMUA SUDUT LANCIP! ========== */
        .card, .btn, .product-card, input, select, textarea, .navbar, .modal-content, .badge {
            border-radius: 0px !important;
        }
        
        /* ========== PRODUCT CARD ========== */
        .product-card {
            background: var(--card-bg);
            border: 1px solid var(--border-color);
            transition: all 0.3s ease;
            height: 100%;
        }
        
        .product-card:hover {
            transform: translateY(-5px);
            box-shadow: var(--shadow-neon);
            border-color: var(--neon-cyan);
        }
        
        /* ========== NEON BUTTON ========== */
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
        
        /* ========== OUTLINE NEON BUTTON ========== */
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
        
        /* ========== NAVBAR GAMING ========== */
        .navbar-gaming {
            background: var(--bg-primary);
            border-bottom: 2px solid var(--border-color);
            padding: 15px 0;
        }
        
        .navbar-gaming .nav-link {
            color: var(--text-primary);
            font-weight: 500;
            margin: 0 10px;
            transition: color 0.3s;
        }
        
        .navbar-gaming .nav-link:hover {
            color: var(--neon-cyan);
        }
        
        /* ========== PRICE TAG ========== */
        .price-tag {
            font-size: 1.3rem;
            font-weight: 700;
            background: var(--accent-gradient);
            -webkit-background-clip: text;
            background-clip: text;
            color: transparent;
        }
        
        /* ========== GAMING BADGE ========== */
        .badge-gaming {
            background: var(--accent-gradient);
            color: white;
            padding: 5px 15px;
            font-weight: 600;
            display: inline-block;
        }
        
        /* ========== FORM CONTROL ========== */
        .form-control, .form-select {
            background: var(--bg-secondary);
            border: 1px solid var(--border-color);
            color: var(--text-primary);
            padding: 10px 15px;
        }
        
        .form-control:focus, .form-select:focus {
            background: var(--bg-primary);
            border-color: var(--neon-cyan);
            box-shadow: none;
            color: var(--text-primary);
        }
        
        .form-control::placeholder {
            color: var(--text-secondary);
        }
        
        /* ========== PRODUCT IMAGE WRAPPER ========== */
        .product-img-wrapper {
            height: 160px;
            display: flex;
            align-items: center;
            justify-content: center;
            background: var(--bg-secondary);
            overflow: hidden;
        }
        
        .product-img-wrapper img {
            max-width: 100%;
            max-height: 100%;
            object-fit: contain;
        }
        
        /* ========== FOOTER ========== */
        .footer-gaming {
            background: var(--bg-secondary);
            border-top: 2px solid var(--border-color);
            padding: 20px 0;
            margin-top: 50px;
        }
        
        /* ========== TABLE STYLING ========== */
        .table-gaming {
            background: var(--card-bg);
            color: var(--text-primary);
        }
        
        .table-gaming th {
            background: var(--bg-secondary);
            border: none;
        }
        
        /* ========== DROPDOWN MENU ========== */
        .dropdown-menu {
            border-radius: 0px !important;
            border-color: var(--border-color);
        }
        
        /* ========== PAGINATION ========== */
        .pagination .page-link {
            color: var(--neon-blue);
            border-radius: 0px !important;
        }
        
        .pagination .page-link:hover {
            background: var(--accent-gradient);
            color: white;
            border-color: transparent;
        }
        
        /* ========== ALERT STYLING ========== */
        .alert {
            border-radius: 0px !important;
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
                        <a class="nav-link" href="{{ route('shop.index') }}">
                            <i class="fas fa-store me-1"></i> TOKO
                        </a>
                    </li>
                    @auth
                        @if(auth()->user()->role === 'admin')
                        <li class="nav-item">
                            <a class="nav-link" href="{{ route('admin.products.index') }}">
                                <i class="fas fa-tachometer-alt me-1"></i> ADMIN
                            </a>
                        </li>
                        @endif
                    @endauth
                </ul>
                
                <div class="d-flex gap-3 align-items-center">
                    @auth
                        <a href="{{ route('cart.index') }}" class="btn btn-outline-neon position-relative">
                            <i class="fas fa-shopping-cart"></i>
                            @php
                                $cartCount = 0;
                                if (auth()->check()) {
                                    $cartCount = \App\Models\Cart::where('user_id', auth()->id())->count();
                                }
                            @endphp
                            @if($cartCount > 0)
                                <span class="position-absolute top-0 start-100 translate-middle badge rounded-pill bg-danger" style="border-radius: 0px !important;">
                                    {{ $cartCount }}
                                </span>
                            @endif
                        </a>
                        <div class="dropdown">
                            <button class="btn btn-neon dropdown-toggle" type="button" data-bs-toggle="dropdown">
                                <i class="fas fa-user me-1"></i>{{ Auth::user()->name }}
                            </button>
                            <ul class="dropdown-menu dropdown-menu-end">
                                <li><a class="dropdown-item" href="{{ route('orders.index') }}">📋 Pesanan</a></li>
                                <li><hr class="dropdown-divider"></li>
                                <li>
                                    <form method="POST" action="{{ route('logout') }}" id="logout-form">
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

    <!-- Main Content -->
    <main>
        @yield('content')
    </main>

    <!-- Footer -->
    <footer class="footer-gaming">
        <div class="container text-center">
            <p class="mb-0">&copy; {{ date('Y') }} Puzzle PC - Premium PC Parts for Gamers</p>
            <small class="text-secondary">Powered by NVIDIA | AMD | INTEL</small>
        </div>
    </footer>

    <!-- Scripts -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
    
    @stack('scripts')
</body>
</html>