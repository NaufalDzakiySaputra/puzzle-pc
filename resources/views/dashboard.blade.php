@extends('layouts.app')

@section('content')
<div class="py-12">
    <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
        <!-- Welcome Card -->
        <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg mb-6">
            <div class="p-6 text-gray-900">
                <h1 class="text-2xl font-bold mb-2">Selamat Datang, {{ Auth::user()->name }}! 👋</h1>
                <p class="text-gray-600">Ini adalah dashboard Anda. Mulai belanja atau kelola produk dari sini.</p>
            </div>
        </div>

        <!-- Statistik Sederhana -->
        <div class="grid grid-cols-1 md:grid-cols-3 gap-6 mb-6">
            <div class="bg-white rounded-lg shadow-sm p-6">
                <div class="flex items-center">
                    <div class="bg-blue-100 rounded-full p-3 mr-4">
                        <i class="fas fa-shopping-bag text-blue-600 text-xl"></i>
                    </div>
                    <div>
                        <p class="text-gray-500 text-sm">Total Pesanan</p>
                        <p class="text-2xl font-bold">{{ \App\Models\Transaction::where('user_id', Auth::id())->count() }}</p>
                    </div>
                </div>
            </div>
            <div class="bg-white rounded-lg shadow-sm p-6">
                <div class="flex items-center">
                    <div class="bg-green-100 rounded-full p-3 mr-4">
                        <i class="fas fa-check-circle text-green-600 text-xl"></i>
                    </div>
                    <div>
                        <p class="text-gray-500 text-sm">Pesanan Selesai</p>
                        <p class="text-2xl font-bold">{{ \App\Models\Transaction::where('user_id', Auth::id())->where('status', 'paid')->count() }}</p>
                    </div>
                </div>
            </div>
            <div class="bg-white rounded-lg shadow-sm p-6">
                <div class="flex items-center">
                    <div class="bg-yellow-100 rounded-full p-3 mr-4">
                        <i class="fas fa-clock text-yellow-600 text-xl"></i>
                    </div>
                    <div>
                        <p class="text-gray-500 text-sm">Menunggu Pembayaran</p>
                        <p class="text-2xl font-bold">{{ \App\Models\Transaction::where('user_id', Auth::id())->where('status', 'pending')->count() }}</p>
                    </div>
                </div>
            </div>
        </div>

        <!-- Quick Actions -->
        <div class="bg-white rounded-lg shadow-sm p-6">
            <h2 class="text-xl font-bold mb-4">Aksi Cepat</h2>
            <div class="flex flex-wrap gap-4">
                <a href="{{ route('shop.index') }}" class="bg-blue-600 text-white px-4 py-2 rounded-lg hover:bg-blue-700">
                    <i class="fas fa-store"></i> Belanja Sekarang
                </a>
                <a href="{{ route('orders.index') }}" class="bg-gray-600 text-white px-4 py-2 rounded-lg hover:bg-gray-700">
                    <i class="fas fa-history"></i> Lihat Pesanan
                </a>
                @if(auth()->user()->role === 'admin')
                <a href="{{ route('admin.products.index') }}" class="bg-green-600 text-white px-4 py-2 rounded-lg hover:bg-green-700">
                    <i class="fas fa-tachometer-alt"></i> Kelola Produk
                </a>
                @endif
            </div>
        </div>
    </div>
</div>
@endsection