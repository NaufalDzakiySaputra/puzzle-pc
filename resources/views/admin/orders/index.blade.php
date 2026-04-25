@extends('layouts.app')

@section('content')
<div class="py-12">
    <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
        <h1 class="text-2xl font-bold mb-6">📋 Manajemen Pesanan</h1>

        <div class="bg-white rounded-lg shadow-md overflow-hidden">
            <table class="w-full">
                <thead class="bg-gray-100">
                    <tr>
                        <th class="px-4 py-3 text-left">Order ID</th>
                        <th class="px-4 py-3 text-left">Customer</th>
                        <th class="px-4 py-3 text-center">Total</th>
                        <th class="px-4 py-3 text-center">Status</th>
                        <th class="px-4 py-3 text-center">Tanggal</th>
                        <th class="px-4 py-3 text-center">Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($transactions as $transaction)
                    <tr class="border-b">
                        <td class="px-4 py-3">{{ $transaction->order_id }}</td>
                        <td class="px-4 py-3">{{ $transaction->user->name }}</td>
                        <td class="px-4 py-3 text-center">Rp {{ number_format($transaction->total_amount, 0, ',', '.') }}</td>
                        <td class="px-4 py-3 text-center">
                            <span class="px-2 py-1 rounded-full text-xs
                                @if($transaction->status == 'paid') bg-green-100 text-green-700
                                @elseif($transaction->status == 'pending') bg-yellow-100 text-yellow-700
                                @else bg-red-100 text-red-700 @endif">
                                {{ $transaction->status }}
                            </span>
                        </td>
                        <td class="px-4 py-3 text-center">{{ $transaction->created_at->format('d/m/Y') }}</td>
                        <td class="px-4 py-3 text-center">
                            <a href="{{ route('admin.orders.show', $transaction) }}" class="text-blue-600 hover:text-blue-800">
                                Detail
                            </a>
                        </td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
        
        <div class="mt-4">
            {{ $transactions->links() }}
        </div>
    </div>
</div>
@endsection