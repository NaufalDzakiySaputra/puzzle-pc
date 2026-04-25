@extends('layouts.app')

@section('content')
<div class="py-12">
    <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
        <h1 class="text-2xl font-bold mb-6"> Riwayat Pesanan</h1>

        @if(session('success'))
            <div class="bg-green-100 border border-green-400 text-green-700 px-4 py-3 rounded mb-4">
                {{ session('success') }}
            </div>
        @endif

        @if(session('error'))
            <div class="bg-red-100 border border-red-400 text-red-700 px-4 py-3 rounded mb-4">
                {{ session('error') }}
            </div>
        @endif

        @if(session('info'))
            <div class="bg-blue-100 border border-blue-400 text-blue-700 px-4 py-3 rounded mb-4">
                {{ session('info') }}
            </div>
        @endif

        <div class="bg-white rounded-lg shadow-md overflow-hidden">
            @forelse($transactions as $transaction)
            <div class="p-4 border-b hover:bg-gray-50">
                <div class="flex justify-between items-center">
                    <div>
                        <p class="font-bold">{{ $transaction->order_id }}</p>
                        <p class="text-sm text-gray-500">{{ $transaction->created_at->format('d/m/Y H:i') }}</p>
                        <p class="text-sm">Total: Rp {{ number_format($transaction->total_amount, 0, ',', '.') }}</p>
                    </div>
                    <div class="text-right">
                        <span class="inline-block px-3 py-1 rounded-full text-sm
                            @if($transaction->status == 'paid') bg-green-100 text-green-700
                            @elseif($transaction->status == 'pending') bg-yellow-100 text-yellow-700
                            @elseif($transaction->status == 'failed') bg-red-100 text-red-700
                            @else bg-gray-100 text-gray-700 @endif">
                            @if($transaction->status == 'paid') Lunas
                            @elseif($transaction->status == 'pending') Menunggu Pembayaran
                            @elseif($transaction->status == 'failed') Gagal
                            @else {{ ucfirst($transaction->status) }}
                            @endif
                        </span>
                        
                        <!-- ✅ TOMBOL CEK STATUS UNTUK YANG MASIH PENDING -->
                        @if($transaction->status == 'pending')
                            <a href="{{ route('cek.pembayaran', $transaction->order_id) }}" 
                               class="block mt-2 text-sm bg-blue-500 hover:bg-blue-700 text-white font-bold py-1 px-3 rounded text-center">
                                <i class="fas fa-sync-alt"></i> Cek Status Pembayaran
                            </a>
                        @endif
                        
                        <a href="{{ route('orders.show', $transaction) }}" 
                           class="block mt-2 text-blue-600 hover:text-blue-800 text-sm">
                            Detail →
                        </a>
                    </div>
                </div>
            </div>
            @empty
            <div class="p-12 text-center">
                <i class="fas fa-box-open text-6xl text-gray-400 mb-4"></i>
                <p class="text-gray-500">Belum ada pesanan</p>
                <a href="{{ route('shop.index') }}" class="inline-block mt-4 bg-blue-600 text-white px-6 py-2 rounded-lg">
                    Belanja Sekarang
                </a>
            </div>
            @endforelse
        </div>
        
        <div class="mt-4">
            {{ $transactions->links() }}
        </div>
    </div>
</div>
@endsection