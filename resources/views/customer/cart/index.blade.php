@extends('layouts.app')

@section('content')
<div class="py-12">
    <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
        <h1 class="text-2xl font-bold mb-6">🛍️ Keranjang Belanja</h1>

        @if(session('success'))
            <div class="bg-green-100 border border-green-400 text-green-700 px-4 py-3 rounded mb-4">
                {{ session('success') }}
            </div>
        @endif

        @if(count($carts) > 0)
            <div class="bg-white rounded-lg shadow-md overflow-hidden">
                <table class="w-full">
                    <thead class="bg-gray-100">
                        <tr>
                            <th class="px-4 py-3 text-left">Produk</th>
                            <th class="px-4 py-3 text-center">Harga</th>
                            <th class="px-4 py-3 text-center">Jumlah</th>
                            <th class="px-4 py-3 text-center">Subtotal</th>
                            <th class="px-4 py-3 text-center"></th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($carts as $cart)
                        <tr class="border-b">
                            <td class="px-4 py-3">
                                <div>
                                    <p class="font-bold">{{ $cart->product->name }}</p>
                                    <p class="text-sm text-gray-500">{{ $cart->product->category }}</p>
                                </div>
                            </td>
                            <td class="px-4 py-3 text-center">
                                Rp {{ number_format($cart->product->price, 0, ',', '.') }}
                            </td>
                            <td class="px-4 py-3">
                                <form action="{{ route('cart.update', $cart) }}" method="POST" class="flex justify-center">
                                    @csrf
                                    @method('PUT')
                                    <input type="number" name="quantity" value="{{ $cart->quantity }}" 
                                           min="1" max="{{ $cart->product->stock }}"
                                           class="border rounded px-2 py-1 w-16 text-center">
                                    <button type="submit" class="ml-2 text-blue-600 hover:text-blue-800">
                                        <i class="fas fa-sync-alt"></i>
                                    </button>
                                </form>
                            </td>
                            <td class="px-4 py-3 text-center font-bold">
                                Rp {{ number_format($cart->product->price * $cart->quantity, 0, ',', '.') }}
                            </td>
                            <td class="px-4 py-3 text-center">
                                <form action="{{ route('cart.destroy', $cart) }}" method="POST">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="text-red-600 hover:text-red-800">
                                        <i class="fas fa-trash"></i>
                                    </button>
                                </form>
                            </td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
                
                <div class="p-4 bg-gray-50">
                    <div class="flex justify-between items-center">
                        <span class="text-xl font-bold">Total:</span>
                        <span class="text-2xl font-bold text-blue-600">
                            Rp {{ number_format($total, 0, ',', '.') }}
                        </span>
                    </div>
                    <div class="flex justify-end gap-4 mt-4">
                        <a href="{{ route('shop.index') }}" class="bg-gray-500 text-white px-6 py-2 rounded-lg">
                            Lanjut Belanja
                        </a>
                        <a href="{{ route('checkout.index') }}" class="bg-green-600 text-white px-6 py-2 rounded-lg">
                            Checkout →
                        </a>
                    </div>
                </div>
            </div>
        @else
            <div class="bg-white rounded-lg shadow-md p-12 text-center">
                <i class="fas fa-shopping-cart text-6xl text-gray-400 mb-4"></i>
                <p class="text-gray-500 text-lg">Keranjang kamu kosong</p>
                <a href="{{ route('shop.index') }}" class="inline-block mt-4 bg-blue-600 text-white px-6 py-2 rounded-lg">
                    Mulai Belanja
                </a>
            </div>
        @endif
    </div>
</div>
@endsection