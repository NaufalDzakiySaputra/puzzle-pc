@extends('layouts.app')

@section('content')
<div class="container py-5">
    <div class="row mb-4">
        <div class="col-12">
            <h1 class="fw-bold" style="background: var(--accent-gradient); -webkit-background-clip: text; background-clip: text; color: transparent;">
                💳 CHECKOUT
            </h1>
            <p class="text-secondary">Complete your payment to finalize order</p>
        </div>
    </div>

    @if(session('error'))
        <div class="alert alert-danger mb-4">{{ session('error') }}</div>
    @endif

    <div class="row g-4">
        <!-- Shipping Information -->
        <div class="col-md-6">
            <div class="product-card p-4">
                <h5 class="fw-bold mb-3">
                    <i class="fas fa-truck me-2" style="color: var(--neon-cyan);"></i>
                    SHIPPING INFORMATION
                </h5>
                
                <div class="mb-3">
                    <label class="form-label fw-bold">Full Name</label>
                    <input type="text" value="{{ Auth::user()->name }}" class="form-control" readonly>
                </div>

                <div class="mb-3">
                    <label class="form-label fw-bold">Email</label>
                    <input type="email" value="{{ Auth::user()->email }}" class="form-control" readonly>
                </div>

                <div class="mb-4">
                    <label class="form-label fw-bold">Shipping Address <span class="text-danger">*</span></label>
                    <textarea id="shipping_address" rows="4" class="form-control" placeholder="Jl. Contoh No. 123, Kota, Kode Pos">{{ old('shipping_address') }}</textarea>
                    <small class="text-secondary">Please complete your address for delivery</small>
                </div>
                
                <button type="button" id="pay-button" class="btn btn-neon w-100 py-3">
                    <i class="fas fa-bolt me-2"></i>PROCEED TO PAYMENT
                </button>
            </div>
        </div>
        
        <!-- Order Summary -->
        <div class="col-md-6">
            <div class="product-card p-4">
                <h5 class="fw-bold mb-3">
                    <i class="fas fa-receipt me-2" style="color: var(--neon-cyan);"></i>
                    ORDER SUMMARY
                </h5>
                
                <div class="mb-3" style="max-height: 300px; overflow-y: auto;">
                    @foreach($carts as $cart)
                    <div class="d-flex justify-content-between mb-3 pb-2 border-bottom" style="border-color: var(--border-color);">
                        <div>
                            <h6 class="fw-bold mb-0">{{ $cart->product->name }}</h6>
                            <small class="text-secondary">{{ $cart->quantity }} x Rp {{ number_format($cart->product->price, 0, ',', '.') }}</small>
                        </div>
                        <span class="fw-bold">Rp {{ number_format($cart->product->price * $cart->quantity, 0, ',', '.') }}</span>
                    </div>
                    @endforeach
                </div>
                
                <hr style="border-color: var(--border-color);">
                
                <div class="d-flex justify-content-between mt-3 pt-2">
                    <span class="fs-5 fw-bold">TOTAL</span>
                    <span class="price-tag fs-2 fw-bold">Rp {{ number_format($total, 0, ',', '.') }}</span>
                </div>
            </div>
        </div>
    </div>
    
    <div class="row mt-4">
        <div class="col-12">
            <a href="{{ route('cart.index') }}" class="text-decoration-none" style="color: var(--neon-cyan);">
                <i class="fas fa-arrow-left me-1"></i> Back to Cart
            </a>
        </div>
    </div>
</div>
@endsection

@push('scripts')
<script src="https://app.sandbox.midtrans.com/snap/snap.js" data-client-key="{{ config('midtrans.client_key') }}"></script>
<script>
    const payButton = document.getElementById('pay-button');
    
    payButton.onclick = function() {
        const shippingAddress = document.getElementById('shipping_address').value;
        
        if (!shippingAddress.trim()) {
            alert('⚠️ Harap isi alamat lengkap terlebih dahulu!');
            return;
        }
        
        // Disable button
        payButton.disabled = true;
        payButton.innerHTML = '<i class="fas fa-spinner fa-spin me-2"></i>PROCESSING...';
        
        // Kirim request ke server - PAKAI RELATIVE PATH
        fetch('/checkout/process', {
            method: 'POST',
            headers: {
                'Content-Type': 'application/json',
                'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content'),
                'Accept': 'application/json'
            },
            body: JSON.stringify({
                shipping_address: shippingAddress
            })
        })
        .then(response => response.json())
        .then(data => {
            console.log('Response:', data);
            
            if (data.success) {
                // Munculkan popup Midtrans
                window.snap.pay(data.snap_token, {
                    onSuccess: function(result) {
                        console.log('Success:', result);
                        window.location.href = '{{ route("orders.index") }}?payment=success';
                    },
                    onPending: function(result) {
                        console.log('Pending:', result);
                        window.location.href = '{{ route("orders.index") }}?payment=pending';
                    },
                    onError: function(result) {
                        console.log('Error:', result);
                        alert('❌ Pembayaran gagal! Silakan coba lagi.');
                        window.location.href = '{{ route("orders.index") }}';
                    },
                    onClose: function() {
                        console.log('Closed');
                        alert('⚠️ Popup pembayaran ditutup. Pesanan tetap tersimpan.');
                        window.location.href = '{{ route("orders.index") }}';
                    }
                });
            } else {
                alert('❌ Error: ' + data.message);
                payButton.disabled = false;
                payButton.innerHTML = '<i class="fas fa-bolt me-2"></i>PROCEED TO PAYMENT';
            }
        })
        .catch(error => {
            console.error('Fetch Error:', error);
            alert('❌ Terjadi kesalahan: ' + error.message);
            payButton.disabled = false;
            payButton.innerHTML = '<i class="fas fa-bolt me-2"></i>PROCEED TO PAYMENT';
        });
    };
</script>
@endpush