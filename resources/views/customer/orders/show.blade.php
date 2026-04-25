@extends('layouts.app')

@section('content')
<div class="py-12">
    <div class="max-w-4xl mx-auto sm:px-6 lg:px-8">
        <div class="bg-white rounded-lg shadow-md overflow-hidden">
            <div class="p-6 border-b">
                <div class="flex justify-between items-center">
                    <div>
                        <h1 class="text-2xl font-bold">Detail Pesanan</h1>
                        <p class="text-gray-500">{{ $transaction->order_id }}</p>
                    </div>
                    <span class="px-4 py-2 rounded-full text-sm font-bold
                        @if($transaction->status == 'paid') bg-green-100 text-green-700
                        @elseif($transaction->status == 'pending') bg-yellow-100 text-yellow-700
                        @elseif($transaction->status == 'failed') bg-red-100 text-red-700
                        @else bg-gray-100 text-gray-700 @endif">
                        {{ ucfirst($transaction->status) }}
                    </span>
                </div>
            </div>
            
            <div class="p-6">
                <div class="mb-6">
                    <h2 class="font-bold text-lg mb-3">Informasi Pengiriman</h2>
                    <p class="text-gray-600">{{ $transaction->shipping_address }}</p>
                    <p class="text-sm text-gray-500 mt-2">Tanggal: {{ $transaction->created_at->format('d/m/Y H:i') }}</p>
                </div>
                
                <h2 class="font-bold text-lg mb-3">Item Pesanan</h2>
                <table class="w-full border">
                    <thead class="bg-gray-100">
                        <tr>
                            <th class="border px-4 py-2 text-left">Produk</th>
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
                            <td class="border px-4 py-2 text-center font-bold">
                                Rp {{ number_format($item->price * $item->quantity, 0, ',', '.') }}
                            </td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
                
                <div class="text-right mt-4 pt-4 border-t">
                    <p class="text-xl font-bold">Total: Rp {{ number_format($transaction->total_amount, 0, ',', '.') }}</p>
                </div>
                
                <div class="mt-6">
                    <a href="{{ route('orders.index') }}" class="text-blue-600 hover:text-blue-800">
                        ← Kembali ke Riwayat
                    </a>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection