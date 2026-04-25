@extends('layouts.app')

@section('content')
<div class="py-12">
    <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
        <!-- Header -->
        <div class="mb-8">
            <h1 class="text-3xl font-bold text-gray-800">🛒 Toko Part PC</h1>
            <p class="text-gray-600">Temukan part PC terbaik untuk build impianmu</p>
        </div>

        <!-- Filter & Search -->
        <div class="bg-white p-4 rounded-lg shadow-sm mb-6">
            <div class="flex flex-wrap gap-4">
                <form action="{{ route('shop.index') }}" method="GET" class="flex flex-wrap gap-4 w-full">
                    <div class="flex-1">
                        <input type="text" name="search" placeholder="Cari produk..." 
                               class="w-full border rounded-lg px-4 py-2"
                               value="{{ request('search') }}">
                    </div>
                    <div class="w-48">
                        <select name="category" class="w-full border rounded-lg px-4 py-2">
                            <option value="">Semua Kategori</option>
                            @foreach($categories as $cat)
                                <option value="{{ $cat }}" {{ request('category') == $cat ? 'selected' : '' }}>
                                    {{ $cat }}
                                </option>
                            @endforeach
                        </select>
                    </div>
                    <button type="submit" class="bg-blue-600 text-white px-6 py-2 rounded-lg hover:bg-blue-700">
                        <i class="fas fa-search"></i> Cari
                    </button>
                </form>
            </div>
        </div>

        <!-- Products Grid -->
        <div class="grid grid-cols-1 md:grid-cols-3 lg:grid-cols-4 gap-6">
            @forelse($products as $product)
            <!-- Card dengan flex column dan tinggi penuh -->
            <div class="bg-white rounded-lg shadow-md overflow-hidden hover:shadow-lg transition flex flex-col h-full">
                <!-- Gambar -->
                <div class="w-full h-40 bg-gray-200 flex items-center justify-center overflow-hidden">
                    @if($product->image)
                        <img src="{{ asset('storage/' . $product->image) }}" alt="{{ $product->name }}" 
                             class="w-full h-full object-cover">
                    @else
                        <i class="fas fa-microchip text-5xl text-gray-400"></i>
                    @endif
                </div>
                
                <!-- Konten (flex-grow agar tombol di bawah) -->
                <div class="p-4 flex flex-col flex-grow">
                    <h3 class="font-bold text-lg mb-1 line-clamp-1">{{ $product->name }}</h3>
                    <p class="text-gray-500 text-sm mb-2">{{ $product->category ?? 'Part PC' }}</p>
                    <p class="text-blue-600 font-bold text-xl mb-2">Rp {{ number_format($product->price, 0, ',', '.') }}</p>
                    <p class="text-gray-500 text-sm mb-3">Stok: {{ $product->stock }}</p>
                    
                    <!-- Tombol (mt-auto = margin top auto, otomatis ke bawah) -->
                    <div class="mt-auto">
                        <a href="{{ route('shop.show', $product) }}" 
                           class="block text-center bg-blue-600 text-white py-2 rounded-lg hover:bg-blue-700">
                            Lihat Detail
                        </a>
                    </div>
                </div>
            </div>
            @empty
            <div class="col-span-full text-center py-12">
                <i class="fas fa-box-open text-6xl text-gray-400 mb-4"></i>
                <p class="text-gray-500">Belum ada produk</p>
            </div>
            @endforelse
        </div>

        <div class="mt-6">
            {{ $products->links() }}
        </div>
    </div>
</div>
@endsection