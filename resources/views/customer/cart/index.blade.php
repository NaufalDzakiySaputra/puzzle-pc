@extends('layouts.app')

@section('content')
<div class="container py-5">
    <div class="row mb-4">
        <div class="col-12">
            <h1 class="fw-bold" style="background: var(--accent-gradient); background-clip: text; -webkit-background-clip: text; color: transparent;">
                🛍️ SHOPPING CART
            </h1>
            <p class="text-secondary">Review your items before checkout</p>
        </div>
    </div>

    @if(session('success'))
        <div class="alert alert-success mb-4">{{ session('success') }}</div>
    @endif

    @if(count($carts) > 0)
        <div class="row">
            <div class="col-lg-8">
                <div class="product-card overflow-hidden">
                    <div class="table-responsive">
                        <table class="table table-borderless align-middle mb-0">
                            <thead style="background: var(--bg-secondary);">
                                <tr>
                                    <th class="px-4 py-3">Product</th>
                                    <th class="px-4 py-3 text-center">Price</th>
                                    <th class="px-4 py-3 text-center">Quantity</th>
                                    <th class="px-4 py-3 text-center">Subtotal</th>
                                    <th class="px-4 py-3 text-center"></th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach($carts as $cart)
                                <tr class="border-bottom" style="border-color: var(--border-color) !important;">
                                    <td class="px-4 py-3">
                                        <div>
                                            <h6 class="fw-bold mb-0">{{ $cart->product->name }}</h6>
                                            <small class="text-secondary">{{ $cart->product->category }}</small>
                                        </div>
                                    </td>
                                    <td class="px-4 py-3 text-center">
                                        Rp {{ number_format($cart->product->price, 0, ',', '.') }}
                                    </td>
                                    <td class="px-4 py-3">
                                        <form action="{{ route('cart.update', $cart) }}" method="POST" class="d-flex justify-content-center gap-2">
                                            @csrf
                                            @method('PUT')
                                            <input type="number" name="quantity" value="{{ $cart->quantity }}" 
                                                   min="1" max="{{ $cart->product->stock }}"
                                                   class="form-control text-center" style="width: 70px;">
                                            <button type="submit" class="btn btn-outline-neon btn-sm">
                                                <i class="fas fa-sync-alt"></i>
                                            </button>
                                        </form>
                                    </td>
                                    <td class="px-4 py-3 text-center fw-bold">
                                        Rp {{ number_format($cart->product->price * $cart->quantity, 0, ',', '.') }}
                                    </td>
                                    <td class="px-4 py-3 text-center">
                                        <form action="{{ route('cart.destroy', $cart) }}" method="POST">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" class="btn btn-sm text-danger">
                                                <i class="fas fa-trash"></i>
                                            </button>
                                        </form>
                                    </td>
                                </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>

            <!-- Cart Summary -->
            <div class="col-lg-4">
                <div class="product-card p-4">
                    <h5 class="fw-bold mb-3">ORDER SUMMARY</h5>
                    <div class="d-flex justify-content-between mb-3">
                        <span>Subtotal</span>
                        <span class="fw-bold">Rp {{ number_format($total, 0, ',', '.') }}</span>
                    </div>
                    <div class="d-flex justify-content-between mb-3">
                        <span>Shipping</span>
                        <span class="text-success">FREE</span>
                    </div>
                    <hr style="border-color: var(--border-color);">
                    <div class="d-flex justify-content-between mb-4">
                        <span class="fw-bold fs-5">TOTAL</span>
                        <span class="price-tag fs-3">Rp {{ number_format($total, 0, ',', '.') }}</span>
                    </div>
                    <div class="d-grid gap-2">
                        <a href="{{ route('checkout.index') }}" class="btn btn-neon py-2">
                            <i class="fas fa-credit-card me-2"></i>CHECKOUT
                        </a>
                        <a href="{{ route('shop.index') }}" class="btn btn-outline-neon py-2">
                            <i class="fas fa-store me-2"></i>CONTINUE SHOPPING
                        </a>
                    </div>
                </div>
            </div>
        </div>
    @else
        <div class="product-card text-center py-5">
            <i class="fas fa-shopping-cart fa-4x text-secondary mb-3"></i>
            <p class="text-secondary fs-5">Your cart is empty</p>
            <a href="{{ route('shop.index') }}" class="btn btn-neon mt-3">
                <i class="fas fa-store me-2"></i>START SHOPPING
            </a>
        </div>
    @endif
</div>
@endsection