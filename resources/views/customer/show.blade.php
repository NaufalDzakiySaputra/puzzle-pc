@extends('layouts.app')

@section('content')
<div class="container py-5">
    <div class="row mb-4">
        <div class="col-12">
            <a href="{{ route('shop.index') }}" class="text-decoration-none" style="color: var(--neon-cyan);">
                <i class="fas fa-arrow-left me-1"></i> Back to Shop
            </a>
        </div>
    </div>

    <div class="row g-4">
        <!-- Product Image -->
        <div class="col-md-6">
            <div class="product-card p-4 text-center">
                @if($product->image)
                    <img src="{{ asset('storage/' . $product->image) }}" 
                         alt="{{ $product->name }}" 
                         class="img-fluid" 
                         style="max-height: 400px; width: auto; display: block; margin: 0 auto;">
                @else
                    <i class="fas fa-microchip fa-6x text-secondary"></i>
                @endif
            </div>
        </div>

        <!-- Product Info -->
        <div class="col-md-6">
            <div class="product-card p-4 h-100 d-flex flex-column">
                <span class="badge-gaming mb-3 align-self-start">PREMIUM</span>
                <h1 class="fw-bold mb-2">{{ $product->name }}</h1>
                <p class="text-secondary mb-3">{{ $product->category ?? 'Part PC' }}</p>
                
                <div class="price-tag display-5 mb-3">Rp {{ number_format($product->price, 0, ',', '.') }}</div>
                
                <div class="mb-4">
                    @if($product->stock > 0)
                        <span class="badge bg-success px-3 py-2" style="border-radius: 0px !important;">
                            ✓ Tersedia ({{ $product->stock }})
                        </span>
                    @else
                        <span class="badge bg-danger px-3 py-2" style="border-radius: 0px !important;">
                            ✗ Stok Habis
                        </span>
                    @endif
                </div>
                
                <div class="mb-4">
                    <h6 class="fw-bold mb-2">SPECIFICATIONS</h6>
                    <p class="text-secondary">{{ $product->description ?? 'Tidak ada deskripsi untuk produk ini.' }}</p>
                </div>

                @if($product->stock > 0)
                <form action="{{ route('cart.add', $product) }}" method="POST" class="mt-auto">
                    @csrf
                    <div class="row g-3 align-items-end">
                        <div class="col-auto">
                            <label class="form-label fw-bold">Quantity</label>
                            <input type="number" name="quantity" value="1" min="1" max="{{ $product->stock }}"
                                   class="form-control text-center" style="width: 100px;">
                        </div>
                        <div class="col">
                            <button type="submit" class="btn btn-neon w-100 py-2">
                                <i class="fas fa-cart-plus me-2"></i>ADD TO CART
                            </button>
                        </div>
                    </div>
                </form>
                @else
                    <button class="btn btn-secondary w-100 py-2" disabled>
                        <i class="fas fa-ban me-2"></i>STOK HABIS
                    </button>
                @endif
            </div>
        </div>
    </div>
</div>
@endsection