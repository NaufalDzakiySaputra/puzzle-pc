@extends('layouts.app')

@section('content')
<div class="py-12">
    <div class="max-w-3xl mx-auto sm:px-6 lg:px-8">
        <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
            <div class="p-6">
                <h1 class="text-2xl font-bold mb-6">✏️ Edit Produk</h1>

                <form action="{{ route('admin.products.update', $product) }}" method="POST">
                    @csrf
                    @method('PUT')
                    
                    <div class="mb-4">
                        <label class="block text-gray-700 font-bold mb-2">Nama Produk</label>
                        <input type="text" name="name" required 
                               class="w-full border rounded-lg px-3 py-2"
                               value="{{ old('name', $product->name) }}">
                    </div>

                    <div class="mb-4">
                        <label class="block text-gray-700 font-bold mb-2">Kategori</label>
                        <select name="category" class="w-full border rounded-lg px-3 py-2">
                            <option value="">Pilih Kategori</option>
                            <option value="CPU" {{ $product->category == 'CPU' ? 'selected' : '' }}>CPU</option>
                            <option value="GPU" {{ $product->category == 'GPU' ? 'selected' : '' }}>GPU / VGA</option>
                            <option value="RAM" {{ $product->category == 'RAM' ? 'selected' : '' }}>RAM</option>
                            <option value="Motherboard" {{ $product->category == 'Motherboard' ? 'selected' : '' }}>Motherboard</option>
                            <option value="Storage" {{ $product->category == 'Storage' ? 'selected' : '' }}>Storage</option>
                            <option value="PSU" {{ $product->category == 'PSU' ? 'selected' : '' }}>PSU</option>
                        </select>
                    </div>

                    <div class="mb-4">
                        <label class="block text-gray-700 font-bold mb-2">Deskripsi</label>
                        <textarea name="description" rows="4" 
                                  class="w-full border rounded-lg px-3 py-2">{{ old('description', $product->description) }}</textarea>
                    </div>

                    <div class="grid grid-cols-2 gap-4 mb-4">
                        <div>
                            <label class="block text-gray-700 font-bold mb-2">Harga</label>
                            <input type="number" name="price" required 
                                   class="w-full border rounded-lg px-3 py-2" value="{{ old('price', $product->price) }}">
                        </div>
                        <div>
                            <label class="block text-gray-700 font-bold mb-2">Stok</label>
                            <input type="number" name="stock" required 
                                   class="w-full border rounded-lg px-3 py-2" value="{{ old('stock', $product->stock) }}">
                        </div>
                    </div>

                    <div class="flex justify-between">
                        <a href="{{ route('admin.products.index') }}" class="bg-gray-500 text-white px-4 py-2 rounded-lg">Batal</a>
                        <button type="submit" class="bg-blue-600 text-white px-4 py-2 rounded-lg">Update</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
@endsection