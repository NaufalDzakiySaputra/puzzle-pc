@extends('layouts.app')

@section('content')
<div class="container py-5">
    <div class="row mb-4">
        <div class="col-12">
            <a href="{{ route('admin.orders.index') }}" class="text-decoration-none mb-3 d-inline-block" style="color: var(--neon-cyan);">
                <i class="fas fa-arrow-left me-1"></i> Back to Orders
            </a>
            <h1 class="fw-bold" style="background: var(--accent-gradient); -webkit-background-clip: text; background-clip: text; color: transparent;">
                🔍 ORDER DETAILS
            </h1>
            <p class="text-secondary">Order ID: <strong>{{ $transaction->order_id }}</strong></p>
        </div>
    </div>

    <div class="row g-4">
        <!-- Customer Info -->
        <div class="col-md-6">
            <div class="product-card p-4">
                <h5 class="fw-bold mb-3">
                    <i class="fas fa-user me-2" style="color: var(--neon-cyan);"></i>
                    CUSTOMER INFORMATION
                </h5>
                <p><strong>Name:</strong> {{ $transaction->user->name }}</p>
                <p><strong>Email:</strong> {{ $transaction->user->email }}</p>
            </div>
        </div>

        <!-- Shipping Info -->
        <div class="col-md-6">
            <div class="product-card p-4">
                <h5 class="fw-bold mb-3">
                    <i class="fas fa-truck me-2" style="color: var(--neon-cyan);"></i>
                    SHIPPING ADDRESS
                </h5>
                <p>{{ $transaction->shipping_address ?? 'No address provided' }}</p>
            </div>
        </div>
    </div>

    <!-- Order Items -->
    <div class="row mt-4">
        <div class="col-12">
            <div class="product-card p-4">
                <h5 class="fw-bold mb-3">
                    <i class="fas fa-box-open me-2" style="color: var(--neon-cyan);"></i>
                    ORDER ITEMS
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
                                <td class="px-3 py-2 fw-bold">{{ $item->product_name }}</td>
                                <td class="px-3 py-2 text-center">{{ $item->quantity }}</td>
                                <td class="px-3 py-2 text-end">Rp {{ number_format($item->price, 0, ',', '.') }}</td>
                                <td class="px-3 py-2 text-end">Rp {{ number_format($item->price * $item->quantity, 0, ',', '.') }}</td>
                            </tr>
                            @endforeach
                        </tbody>
                        <tfoot>
                            <tr>
                                <td colspan="3" class="px-3 py-3 text-end fw-bold fs-5">TOTAL</td>
                                <td class="px-3 py-3 text-end price-tag fs-4">Rp {{ number_format($transaction->total_amount, 0, ',', '.') }}</td>
                            </tr>
                        </tfoot>
                    </table>
                </div>

                <!-- Status Update Form -->
                <hr style="border-color: var(--border-color);">
                <h5 class="fw-bold mb-3">UPDATE ORDER STATUS</h5>
                <form action="{{ route('admin.orders.updateStatus', $transaction) }}" method="POST" class="row g-3">
                    @csrf
                    @method('PUT')
                    <div class="col-md-4">
                        <select name="status" class="form-select">
                            <option value="pending" {{ $transaction->status == 'pending' ? 'selected' : '' }}>Pending</option>
                            <option value="paid" {{ $transaction->status == 'paid' ? 'selected' : '' }}>Paid</option>
                            <option value="challenge" {{ $transaction->status == 'challenge' ? 'selected' : '' }}>Challenge</option>
                            <option value="failed" {{ $transaction->status == 'failed' ? 'selected' : '' }}>Failed</option>
                            <option value="expired" {{ $transaction->status == 'expired' ? 'selected' : '' }}>Expired</option>
                        </select>
                    </div>
                    <div class="col-md-8">
                        <button type="submit" class="btn btn-neon">
                            <i class="fas fa-sync-alt me-1"></i> UPDATE STATUS
                        </button>
                        <a href="{{ route('admin.orders.index') }}" class="btn btn-outline-neon ms-2">
                            <i class="fas fa-arrow-left me-1"></i> BACK
                        </a>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
@endsection