@extends('layouts.app')

@section('content')
<div class="py-12">
    <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
        <div class="bg-white rounded-lg shadow-md overflow-hidden">
            <div class="grid md:grid-cols-2 gap-8 p-6">
                <!-- Image -->
                <div class="bg-gray-100 rounded-lg h-64 flex items-center justify-center">
                    <i class="fas fa-microchip text-6xl text-gray-500"></i>
                </div>
                
                <!-- Details -->
                <div>
                    <h1 class="text-3xl font-bold mb-2">{{ $product->name }}</h1>
                    <p class="text-gray-500 mb-2">{{ $product->category ?? 'Part PC' }}</p>
                    <p class="text-3xl font-bold text-blue-600 mb-4">
                        Rp {{ number_format($product->price, 0, ',', '.') }}
                    </p>
                    
                    <div class="mb-4">
                        <span class="px-3 py-1 rounded-full text-sm 
                            {{ $product->stock > 0 ? 'bg-green-100 text-green-700' : 'bg-red-100 text-red-700' }}">
                            {{ $product->stock > 0 ? "Tersedia ({$product->stock})" : 'Stok Habis' }}
                        </span>
                    </div>
                    
                    <p class="text-gray-600 mb-6">{{ $product->description ?? 'Tidak ada deskripsi' }}</p>
                    
                    @if($product->stock > 0)
                    <form action="{{ route('cart.add', $product) }}" method="POST" class="flex gap-4">
                        @csrf
                        <input type="number" name="quantity" value="1" min="1" max="{{ $product->stock }}"
                               class="border rounded-lg px-4 py-2 w-24 text-center">
                        <button type="submit" class="bg-blue-600 text-white px-6 py-2 rounded-lg hover:bg-blue-700">
                            <i class="fas fa-cart-plus"></i> Tambah ke Keranjang
                        </button>
                    </form>
                    @else
                    <button disabled class="bg-gray-400 text-white px-6 py-2 rounded-lg cursor-not-allowed">
                        Stok Habis
                    </button>
                    @endif
                </div>
            </div>
        </div>
    </div>
</div>
@endsection