@extends('layouts.app')

@section('content')
<div class="container py-5">
    <div class="row mb-4">
        <div class="col-12">
            <h1 class="fw-bold" style="background: var(--accent-gradient); -webkit-background-clip: text; background-clip: text; color: transparent;">
                📋 MANAGE ORDERS
            </h1>
            <p class="text-secondary">Track and manage customer orders</p>
        </div>
    </div>

    <div class="product-card overflow-hidden">
        <div class="table-responsive">
            <table class="table table-borderless align-middle mb-0">
                <thead style="background: var(--bg-secondary);">
                    <tr>
                        <th class="px-3 py-3">Order ID</th>
                        <th class="px-3 py-3">Customer</th>
                        <th class="px-3 py-3 text-end">Total</th>
                        <th class="px-3 py-3 text-center">Status</th>
                        <th class="px-3 py-3 text-center">Date</th>
                        <th class="px-3 py-3 text-center">Actions</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($transactions as $transaction)
                    <tr class="border-bottom" style="border-color: var(--border-color);">
                        <td class="px-3 py-3 fw-bold">{{ $transaction->order_id }}</td>
                        <td class="px-3 py-3">{{ $transaction->user->name }}</td>
                        <td class="px-3 py-3 text-end price-tag">Rp {{ number_format($transaction->total_amount, 0, ',', '.') }}</td>
                        <td class="px-3 py-3 text-center">
                            @php
                                $statusClass = match($transaction->status) {
                                    'paid' => 'bg-success',
                                    'pending' => 'bg-warning text-dark',
                                    'challenge' => 'bg-info text-dark',
                                    'expired' => 'bg-secondary',
                                    default => 'bg-danger'
                                };
                            @endphp
                            <span class="badge {{ $statusClass }}" style="border-radius: 0px; padding: 5px 12px;">
                                {{ ucfirst($transaction->status) }}
                            </span>
                        </td>
                        <td class="px-3 py-3 text-center">{{ $transaction->created_at->format('d/m/Y') }}</td>
                        <td class="px-3 py-3 text-center">
                            <a href="{{ route('admin.orders.show', $transaction) }}" class="btn btn-outline-neon btn-sm">
                                <i class="fas fa-eye me-1"></i> Detail
                            </a>
                        </td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
    
    <div class="row mt-4">
        <div class="col-12">
            {{ $transactions->links('pagination::bootstrap-5') }}
        </div>
    </div>
</div>
@endsection