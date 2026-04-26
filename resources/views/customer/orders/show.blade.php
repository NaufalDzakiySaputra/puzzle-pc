@extends('layouts.app')

@section('content')
<div class="container py-5">
    <div class="row mb-4">
        <div class="col-12">
            <a href="{{ route('orders.index') }}" class="text-decoration-none mb-3 d-inline-block" style="color: var(--neon-cyan);">
                <i class="fas fa-arrow-left me-1"></i> Back to Orders
            </a>
            <h1 class="fw-bold" style="background: var(--accent-gradient); background-clip: text; -webkit-background-clip: text; color: transparent;">
                📄 ORDER DETAILS
            </h1>
            <p class="text-secondary">Order ID: <strong>{{ $transaction->order_id }}</strong></p>
        </div>
    </div>

    <div class="row g-4">
        <!-- Order Info -->
        <div class="col-md-6">
            <div class="product-card p-4">
                <h5 class="fw-bold mb-3">
                    <i class="fas fa-info-circle me-2" style="color: var(--neon-cyan);"></i>
                    ORDER INFORMATION
                </h5>
                <div class="mb-2">
                    <small class="text-secondary">Date</small>
                    <p class="fw-bold">{{ $transaction->created_at->format('d/m/Y H:i:s') }}</p>
                </div>
                <div class="mb-2">
                    <small class="text-secondary">Status</small>
                    <div>
                        @php
                            $statusConfig = [
                                'paid'      => ['bg-success', 'Lunas'],
                                'pending'   => ['bg-warning text-dark', 'Menunggu Pembayaran'],
                                'failed'    => ['bg-danger', 'Gagal'],
                                'expired'   => ['bg-secondary', 'Kadaluarsa'],
                                'challenge' => ['bg-info text-dark', 'Sedang Direview'],
                            ];
                            $config = $statusConfig[$transaction->status] ?? ['bg-secondary', ucfirst($transaction->status)];
                        @endphp
                        <span class="badge {{ $config[0] }} px-3 py-2">{{ $config[1] }}</span>
                    </div>
                </div>
                <div class="mb-2">
                    <small class="text-secondary">Payment Method</small>
                    <p class="fw-bold">{{ $transaction->payment_method ?? 'Midtrans' }}</p>
                </div>
            </div>
        </div>

        <!-- Shipping Info -->
        <div class="col-md-6">
            <div class="product-card p-4">
                <h5 class="fw-bold mb-3">
                    <i class="fas fa-truck me-2" style="color: var(--neon-cyan);"></i>
                    SHIPPING ADDRESS
                </h5>
                <p class="mb-0">{{ $transaction->shipping_address ?? 'Alamat tidak tersedia' }}</p>
            </div>
        </div>

        <!-- Products -->
        <div class="col-12">
            <div class="product-card p-4">
                <h5 class="fw-bold mb-3">
                    <i class="fas fa-box-open me-2" style="color: var(--neon-cyan);"></i>
                    PRODUCTS
                </h5>
                <div class="table-responsive">
                    <table class="table table-borderless">
                        <thead style="background: var(--bg-secondary);">
                            <tr>
                                <th class="px-3 py-2">Product</th>
                                <th class="px-3 py-2 text-center">Quantity</th>
                                <th class="px-3 py-2 text-end">Price</th>
                                <th class="px-3 py-2 text-end">Subtotal</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($transaction->items as $item)
                            <tr class="border-bottom" style="border-color: var(--border-color);">
                                <td class="px-3 py-2">
                                    <strong>{{ $item->product_name }}</strong>
                                </td>
                                <td class="px-3 py-2 text-center">{{ $item->quantity }}</td>
                                <td class="px-3 py-2 text-end">Rp {{ number_format($item->price, 0, ',', '.') }}</td>
                                <td class="px-3 py-2 text-end fw-bold">Rp {{ number_format($item->price * $item->quantity, 0, ',', '.') }}</td>
                            </tr>
                            @endforeach
                        </tbody>
                        <tfoot>
                            <tr>
                                <td colspan="3" class="px-3 py-2 text-end fw-bold fs-5">TOTAL</td>
                                <td class="px-3 py-2 text-end price-tag fs-4">Rp {{ number_format($transaction->total_amount, 0, ',', '.') }}</td>
                            </tr>
                        </tfoot>
                    </table>
                </div>
            </div>
        </div>
    </div>

    <!-- Cek Status Button for Pending/Challenge -->
    @if(in_array($transaction->status, ['pending', 'challenge']))
    <div class="row mt-4">
        <div class="col-12">
            <div class="product-card p-4" style="background: rgba(255, 193, 7, 0.1); border-color: #ffc107;">
                <div class="d-flex justify-content-between align-items-center flex-wrap gap-3">
                    <div>
                        <i class="fas fa-hourglass-half fa-2x me-3" style="color: #ffc107;"></i>
                        <span class="fw-bold">Pembayaran belum terkonfirmasi</span>
                        <p class="mb-0 text-secondary mt-1">Klik tombol di samping untuk cek status terbaru</p>
                    </div>
                    <a href="{{ route('cek.pembayaran', $transaction->order_id) }}" class="btn btn-neon">
                        <i class="fas fa-sync-alt me-2"></i>CEK STATUS PEMBAYARAN
                    </a>
                </div>
            </div>
        </div>
    </div>
    @endif
</div>
@endsection