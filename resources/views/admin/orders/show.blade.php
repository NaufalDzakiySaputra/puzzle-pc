@extends('layouts.app')

@section('content')
<div class="py-12">
    <div class="max-w-4xl mx-auto sm:px-6 lg:px-8">
        <div class="bg-white rounded-lg shadow-md overflow-hidden">
            <div class="p-6 border-b">
                <h1 class="text-2xl font-bold">Detail Pesanan #{{ $transaction->order_id }}</h1>
            </div>
            
            <div class="p-6">
                <div class="grid md:grid-cols-2 gap-6 mb-6">
                    <div>
                        <h2 class="font-bold mb-2">Informasi Customer</h2>
                        <p><strong>Nama:</strong> {{ $transaction->user->name }}</p>
                        <p><strong>Email:</strong> {{ $transaction->user->email }}</p>
                    </div>
                    <div>
                        <h2 class="font-bold mb-2">Informasi Pengiriman</h2>
                        <p>{{ $transaction->shipping_address }}</p>
                        <p><strong>Status:</strong> 
                            <span class="px-2 py-1 rounded-full text-xs
                                @if($transaction->status == 'paid') bg-green-100 text-green-700
                                @elseif($transaction->status == 'pending') bg-yellow-100 text-yellow-700
                                @else bg-red-100 text-red-700 @endif">
                                {{ $transaction->status }}
                            </span>
                        </p>
                    </div>
                </div>
                
                <h2 class="font-bold mb-3">Item Pesanan</h2>
                <table class="w-full border mb-6">
                    <thead class="bg-gray-100">
                        <tr>
                            <th class="border px-4 py-2">Produk</th>
                            <th class="border px-4 py-2 text-center">Jumlah</th>
                            <th class="border px-4 py-2 text-center">Harga</th>
                            <th class="border px-4 py-2 text-center">Subtotal</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($transaction->items as $item)
                        <tr>
                            <td class="border px-4 py-2">{{ $item->product_name }}</td>
                            <td class="border px-4 py-2 text-center">{{ $item->quantity }}</td>
                            <td class="border px-4 py-2 text-center">Rp {{ number_format($item->price, 0, ',', '.') }}</td>
                            <td class="border px-4 py-2 text-center">Rp {{ number_format($item->price * $item->quantity, 0, ',', '.') }}</td>
                        </tr>
                        @endforeach
                    </tbody>
                    <tfoot class="bg-gray-50">
                        <tr>
                            <td colspan="3" class="border px-4 py-2 text-right font-bold">Total:</td>
                            <td class="border px-4 py-2 text-center font-bold">Rp {{ number_format($transaction->total_amount, 0, ',', '.') }}</td>
                        </tr>
                    </tfoot>
                </table>
                
                <form action="{{ route('admin.orders.updateStatus', $transaction) }}" method="POST" class="flex gap-4">
                    @csrf
                    @method('PUT')
                    <select name="status" class="border rounded-lg px-3 py-2">
                        <option value="pending" {{ $transaction->status == 'pending' ? 'selected' : '' }}>Pending</option>
                        <option value="paid" {{ $transaction->status == 'paid' ? 'selected' : '' }}>Paid</option>
                        <option value="failed" {{ $transaction->status == 'failed' ? 'selected' : '' }}>Failed</option>
                        <option value="expired" {{ $transaction->status == 'expired' ? 'selected' : '' }}>Expired</option>
                    </select>
                    <button type="submit" class="bg-blue-600 text-white px-4 py-2 rounded-lg">Update Status</button>
                    <a href="{{ route('admin.orders.index') }}" class="bg-gray-500 text-white px-4 py-2 rounded-lg">Kembali</a>
                </form>
            </div>
        </div>
    </div>
</div>
@endsection