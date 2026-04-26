@extends('layouts.app')

@section('content')
<div class="container py-5">
    <!-- Hero Section Gaming dengan Gradient Neon Cyan -->
    <div class="row mb-5">
        <div class="col-12">
            <div class="product-card p-5 text-center position-relative overflow-hidden" style="background: linear-gradient(135deg, #00e5ff 0%, #2979ff 50%, #0d1b3e 100%); border: 1px solid var(--neon-cyan); box-shadow: 0 0 20px rgba(0, 229, 255, 0.4);">
                <div class="position-relative" style="z-index: 2;">
                    <h1 class="display-4 fw-bold" style="color: white; text-shadow: 0 0 10px rgba(0, 229, 255, 0.8), 0 0 20px rgba(41, 121, 255, 0.5);">
                        🛒 GAMING GEAR
                    </h1>
                    <p class="lead" style="color: rgba(255,255,255,0.9);">Level up your gaming experience with premium PC parts</p>
                </div>
                <!-- Efek garis neon di pinggir -->
                <div style="position: absolute; top: 0; left: 0; right: 0; bottom: 0; border: 2px solid rgba(0, 229, 255, 0.6); pointer-events: none; box-shadow: inset 0 0 30px rgba(0, 229, 255, 0.3);"></div>
                <!-- Efek grid futuristic -->
                <div style="position: absolute; top: 0; left: 0; right: 0; bottom: 0; background-image: radial-gradient(rgba(255,255,255,0.1) 1px, transparent 1px); background-size: 30px 30px; pointer-events: none;"></div>
            </div>
        </div>
    </div>

    <!-- Filter & Search -->
    <div class="row mb-4">
        <div class="col-12">
            <div class="product-card p-4">
                <form action="{{ route('shop.index') }}" method="GET" class="row g-3">
                    <div class="col-md-6">
                        <input type="text" name="search" placeholder="Cari produk..." 
                               class="form-control" value="{{ request('search') }}">
                    </div>
                    <div class="col-md-4">
                        <select name="category" class="form-select">
                            <option value="">Semua Kategori</option>
                            @foreach($categories as $cat)
                                <option value="{{ $cat }}" {{ request('category') == $cat ? 'selected' : '' }}>
                                    {{ $cat }}
                                </option>
                            @endforeach
                        </select>
                    </div>
                    <div class="col-md-2">
                        <button type="submit" class="btn btn-neon w-100">
                            <i class="fas fa-search me-2"></i>CARI
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>

    <!-- Products Grid -->
    <div class="row g-4">
        @forelse($products as $product)
        <div class="col-md-6 col-lg-3">
            <div class="product-card h-100 d-flex flex-column">
                <!-- Image -->
                <div class="product-img-wrapper" style="height: 160px; background: var(--bg-secondary); display: flex; align-items: center; justify-content: center;">
                    @if($product->image)
                        <img src="{{ asset('storage/' . $product->image) }}" 
                             alt="{{ $product->name }}" 
                             style="max-height: 140px; max-width: 100%; object-fit: contain;">
                    @else
                        <i class="fas fa-microchip fa-4x" style="color: var(--neon-cyan);"></i>
                    @endif
                </div>
                
                <!-- Content -->
                <div class="p-3 d-flex flex-column flex-grow-1">
                    <h6 class="fw-bold mb-1" style="min-height: 40px; overflow: hidden; display: -webkit-box; -webkit-line-clamp: 2; -webkit-box-orient: vertical;">
                        {{ $product->name }}
                    </h6>
                    <p class="text-secondary small mb-2">{{ $product->category ?? 'Part PC' }}</p>
                    
                    <div class="price-tag mb-1" style="font-size: 1.1rem;">Rp {{ number_format($product->price, 0, ',', '.') }}</div>
                    <p class="text-secondary small mb-3">Stok: {{ $product->stock }}</p>
                    
                    <div class="mt-auto">
                        <a href="{{ route('shop.show', $product) }}" class="btn btn-outline-neon w-100 py-2" style="font-size: 0.85rem;">
                            <i class="fas fa-eye me-1"></i> DETAIL
                        </a>
                    </div>
                </div>
            </div>
        </div>
        @empty
        <div class="col-12 text-center py-5">
            <i class="fas fa-box-open fa-4x text-secondary mb-3"></i>
            <p class="text-secondary">Belum ada produk</p>
        </div>
        @endforelse
    </div>

    <!-- Pagination -->
    <div class="row mt-5">
        <div class="col-12">
            {{ $products->links('pagination::bootstrap-5') }}
        </div>
    </div>
</div>
@endsection