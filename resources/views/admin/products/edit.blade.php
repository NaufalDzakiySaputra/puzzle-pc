@extends('layouts.app')

@section('content')
<div class="py-12">
    <div class="max-w-3xl mx-auto sm:px-6 lg:px-8">
        <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
            <div class="p-6">
                <h1 class="text-2xl font-bold mb-6">✏️ Edit Produk</h1>

                <form action="{{ route('admin.products.update', $product) }}" method="POST" enctype="multipart/form-data">
                    @csrf
                    @method('PUT')
                    
                    <div class="mb-4">
                        <label class="block text-gray-700 font-bold mb-2">Nama Produk</label>
                        <input type="text" name="name" required 
                               class="w-full border rounded-lg px-3 py-2 focus:outline-none focus:border-blue-500"
                               value="{{ old('name', $product->name) }}">
                        @error('name') <p class="text-red-500 text-sm">{{ $message }}</p> @enderror
                    </div>

                    <div class="mb-4">
                        <label class="block text-gray-700 font-bold mb-2">Kategori</label>
                        <select name="category" class="w-full border rounded-lg px-3 py-2">
                            <option value="">Pilih Kategori</option>
                            <option value="CPU" {{ old('category', $product->category) == 'CPU' ? 'selected' : '' }}>CPU</option>
                            <option value="GPU" {{ old('category', $product->category) == 'GPU' ? 'selected' : '' }}>GPU / VGA</option>
                            <option value="RAM" {{ old('category', $product->category) == 'RAM' ? 'selected' : '' }}>RAM</option>
                            <option value="Motherboard" {{ old('category', $product->category) == 'Motherboard' ? 'selected' : '' }}>Motherboard</option>
                            <option value="Storage" {{ old('category', $product->category) == 'Storage' ? 'selected' : '' }}>Storage (SSD/HDD)</option>
                            <option value="PSU" {{ old('category', $product->category) == 'PSU' ? 'selected' : '' }}>PSU / Power Supply</option>
                            <option value="Casing" {{ old('category', $product->category) == 'Casing' ? 'selected' : '' }}>Casing</option>
                            <option value="Cooling" {{ old('category', $product->category) == 'Cooling' ? 'selected' : '' }}>Cooling / Fan</option>
                        </select>
                    </div>

                    <div class="mb-4">
                        <label class="block text-gray-700 font-bold mb-2">Deskripsi</label>
                        <textarea name="description" rows="4" 
                                  class="w-full border rounded-lg px-3 py-2">{{ old('description', $product->description) }}</textarea>
                    </div>

                    <div class="grid grid-cols-2 gap-4 mb-4">
                        <div>
                            <label class="block text-gray-700 font-bold mb-2">Harga (Rp)</label>
                            <input type="number" name="price" required 
                                   class="w-full border rounded-lg px-3 py-2" value="{{ old('price', $product->price) }}">
                        </div>
                        <div>
                            <label class="block text-gray-700 font-bold mb-2">Stok</label>
                            <input type="number" name="stock" required 
                                   class="w-full border rounded-lg px-3 py-2" value="{{ old('stock', $product->stock) }}">
                        </div>
                    </div>

                    <div class="mb-4">
                        <label class="block text-gray-700 font-bold mb-2">Gambar Produk</label>
                        
                        @if($product->image)
                            <div class="mb-2">
                                <img src="{{ asset('storage/' . $product->image) }}" alt="{{ $product->name }}" 
                                     class="w-32 h-32 object-cover rounded">
                                <p class="text-sm text-gray-500 mt-1">Gambar saat ini</p>
                            </div>
                        @endif
                        
                        <input type="file" name="image" accept="image/jpeg,image/png,image/jpg"
                               class="w-full border rounded-lg px-3 py-2">
                        <p class="text-sm text-gray-500 mt-1">Kosongkan jika tidak ingin mengubah gambar. Format: JPG, JPEG, PNG (Max 2MB)</p>
                        @error('image') <p class="text-red-500 text-sm">{{ $message }}</p> @enderror
                    </div>

                    <div class="flex justify-between">
                        <a href="{{ route('admin.products.index') }}" class="bg-gray-500 text-white px-4 py-2 rounded-lg hover:bg-gray-600">Batal</a>
                        <button type="submit" class="bg-blue-600 text-white px-4 py-2 rounded-lg hover:bg-blue-700">Update</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
@endsection