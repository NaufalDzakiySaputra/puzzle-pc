@extends('layouts.app')

@section('content')
<div class="container py-5">
    <div class="row mb-4">
        <div class="col-12">
            <h1 class="fw-bold" style="background: var(--accent-gradient); background-clip: text; -webkit-background-clip: text; color: transparent;">
                🧾 ORDER HISTORY
            </h1>
            <p class="text-secondary">Track your gaming gear orders</p>
        </div>
    </div>

    @foreach(['success', 'error', 'info', 'warning'] as $type)
        @if(session($type))
            <div class="alert alert-{{ $type == 'error' ? 'danger' : $type }} mb-4">
                {{ session($type) }}
            </div>
        @endif
    @endforeach

    <div class="row">
        <div class="col-12">
            @forelse($transactions as $transaction)
            <div class="product-card p-4 mb-3">
                <div class="row align-items-center">
                    <div class="col-md-5">
                        <h6 class="fw-bold mb-1">{{ $transaction->order_id }}</h6>
                        <small class="text-secondary">{{ $transaction->created_at->format('d/m/Y H:i') }}</small>
                        <div class="mt-1">
                            <span class="fw-bold">Total:</span> 
                            <span class="price-tag">Rp {{ number_format($transaction->total_amount, 0, ',', '.') }}</span>
                        </div>
                    </div>
                    <div class="col-md-4">
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
                    <div class="col-md-3 text-md-end mt-3 mt-md-0">
                        <a href="{{ route('orders.show', $transaction) }}" class="btn btn-outline-neon btn-sm me-2">
                            <i class="fas fa-eye me-1"></i>Detail
                        </a>
                        @if(in_array($transaction->status, ['pending', 'challenge']))
                            <a href="{{ route('cek.pembayaran', $transaction->order_id) }}" class="btn btn-neon btn-sm">
                                <i class="fas fa-sync-alt me-1"></i>Cek Status
                            </a>
                        @endif
                    </div>
                </div>
            </div>
            @empty
            <div class="product-card text-center py-5">
                <i class="fas fa-inbox fa-4x text-secondary mb-3"></i>
                <p class="text-secondary fs-5">No orders yet</p>
                <a href="{{ route('shop.index') }}" class="btn btn-neon mt-3">
                    <i class="fas fa-store me-2"></i>START SHOPPING
                </a>
            </div>
            @endforelse
        </div>
    </div>

    <div class="row mt-4">
        <div class="col-12">
            {{ $transactions->links('pagination::bootstrap-5') }}
        </div>
    </div>
</div>
@endsection