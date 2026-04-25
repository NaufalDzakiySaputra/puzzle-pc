@extends('layouts.app')

@section('content')
<div class="py-12">
    <div class="max-w-4xl mx-auto sm:px-6 lg:px-8">
        <h1 class="text-2xl font-bold mb-6">📋 Checkout</h1>

        @if(session('error'))
            <div class="bg-red-100 border border-red-400 text-red-700 px-4 py-3 rounded mb-4">
                {{ session('error') }}
            </div>
        @endif

        <div class="grid md:grid-cols-2 gap-6">
            <!-- Form Informasi Pengiriman -->
            <div class="bg-white rounded-lg shadow-md p-6">
                <h2 class="font-bold text-lg mb-4">Informasi Pengiriman</h2>
                
                <div class="mb-4">
                    <label class="block text-gray-700 font-bold mb-2">Nama Lengkap</label>
                    <input type="text" value="{{ Auth::user()->name }}" 
                           class="w-full border rounded-lg px-3 py-2 bg-gray-100" readonly>
                </div>

                <div class="mb-4">
                    <label class="block text-gray-700 font-bold mb-2">Email</label>
                    <input type="email" value="{{ Auth::user()->email }}" 
                           class="w-full border rounded-lg px-3 py-2 bg-gray-100" readonly>
                </div>

                <div class="mb-4">
                    <label class="block text-gray-700 font-bold mb-2">Alamat Lengkap</label>
                    <textarea id="shipping_address" rows="4" required
                              class="w-full border rounded-lg px-3 py-2 focus:outline-none focus:border-blue-500"
                              placeholder="Jl. Contoh No. 123, Kota, Kode Pos">{{ old('shipping_address') }}</textarea>
                </div>
                
                <button 
                    type="button" 
                    id="pay-button" 
                    class="w-full bg-green-600 text-white py-3 rounded-lg font-bold hover:bg-green-700 transition"
                >
                    Proses Pesanan
                </button>
            </div>
            
            <!-- Ringkasan Pesanan -->
            <div class="bg-white rounded-lg shadow-md p-6">
                <h2 class="font-bold text-lg mb-4">Ringkasan Pesanan</h2>
                
                @foreach($carts as $cart)
                <div class="flex justify-between mb-3 pb-3 border-b">
                    <div>
                        <p class="font-bold">{{ $cart->product->name }}</p>
                        <p class="text-sm text-gray-500">{{ $cart->quantity }} x Rp {{ number_format($cart->product->price, 0, ',', '.') }}</p>
                    </div>
                    <p class="font-bold">Rp {{ number_format($cart->product->price * $cart->quantity, 0, ',', '.') }}</p>
                </div>
                @endforeach
                
                <div class="flex justify-between mt-4 pt-4 border-t-2">
                    <span class="text-xl font-bold">Total</span>
                    <span class="text-2xl font-bold text-blue-600">
                        Rp {{ number_format($total, 0, ',', '.') }}
                    </span>
                </div>
            </div>
        </div>
        
        <div class="mt-4">
            <a href="{{ route('cart.index') }}" class="text-blue-600 hover:text-blue-800">
                ← Kembali ke Keranjang
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
            alert('Harap isi alamat lengkap terlebih dahulu!');
            return;
        }
        
        // Disable button dan tampilkan loading
        payButton.disabled = true;
        payButton.innerText = 'Memproses...';
        
        // Kirim request ke server
        fetch('https://achiness-justifier-hypnotize.ngrok-free.dev/checkout/process', {
            method: 'POST',
            headers: {
                'Content-Type': 'application/json',
                'X-CSRF-TOKEN': '{{ csrf_token() }}'
            },
            body: JSON.stringify({
                shipping_address: shippingAddress
            })
        })
        .then(response => response.json())
        .then(data => {
            payButton.disabled = false;
            payButton.innerText = 'Proses Pesanan';
            
            if (data.success) {
                // 🎯 Munculkan popup Midtrans
                window.snap.pay(data.snap_token, {
                    onSuccess: function(result) {
                        window.location.href = '{{ route("orders.index") }}?payment=success';
                    },
                    onPending: function(result) {
                        window.location.href = '{{ route("orders.index") }}?payment=pending';
                    },
                    onError: function(result) {
                        alert('Pembayaran gagal! Silakan coba lagi.');
                        window.location.href = '{{ route("orders.index") }}';
                    },
                    onClose: function() {
                        alert('Popup pembayaran ditutup. Pesanan tetap tersimpan.');
                        window.location.href = '{{ route("orders.index") }}';
                    }
                });
            } else {
                alert('Error: ' + data.message);
            }
        })
        .catch(error => {
            payButton.disabled = false;
            payButton.innerText = 'Proses Pesanan';
            console.error('Error:', error);
            alert('Terjadi kesalahan pada server. Silakan coba lagi.');
        });
    };
</script>
@endpush