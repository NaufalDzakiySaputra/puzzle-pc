@extends('layouts.app')

@section('content')
<div class="py-12">
    <div class="max-w-3xl mx-auto sm:px-6 lg:px-8">
        <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
            <div class="p-6">
                <h1 class="text-2xl font-bold mb-6">+ Tambah Produk Baru</h1>

                <form action="{{ route('admin.products.store') }}" method="POST">
                    @csrf
                    
                    <div class="mb-4">
                        <label class="block text-gray-700 font-bold mb-2">Nama Produk</label>
                        <input type="text" name="name" required 
                               class="w-full border rounded-lg px-3 py-2 focus:outline-none focus:border-blue-500"
                               value="{{ old('name') }}">
                        @error('name') <p class="text-red-500 text-sm">{{ $message }}</p> @enderror
                    </div>

                    <div class="mb-4">
                        <label class="block text-gray-700 font-bold mb-2">Kategori</label>
                        <select name="category" class="w-full border rounded-lg px-3 py-2">
                            <option value="">Pilih Kategori</option>
                            <option value="CPU">CPU</option>
                            <option value="GPU">GPU / VGA</option>
                            <option value="RAM">RAM</option>
                            <option value="Motherboard">Motherboard</option>
                            <option value="Storage">Storage (SSD/HDD)</option>
                            <option value="PSU">PSU / Power Supply</option>
                            <option value="Casing">Casing</option>
                            <option value="Cooling">Cooling / Fan</option>
                        </select>
                    </div>

                    <div class="mb-4">
                        <label class="block text-gray-700 font-bold mb-2">Deskripsi</label>
                        <textarea name="description" rows="4" 
                                  class="w-full border rounded-lg px-3 py-2">{{ old('description') }}</textarea>
                    </div>

                    <div class="grid grid-cols-2 gap-4 mb-4">
                        <div>
                            <label class="block text-gray-700 font-bold mb-2">Harga (Rp)</label>
                            <input type="number" name="price" required 
                                   class="w-full border rounded-lg px-3 py-2" value="{{ old('price') }}">
                        </div>
                        <div>
                            <label class="block text-gray-700 font-bold mb-2">Stok</label>
                            <input type="number" name="stock" required 
                                   class="w-full border rounded-lg px-3 py-2" value="{{ old('stock') }}">
                        </div>
                    </div>

                    <div class="mb-4">
                        <label class="block text-gray-700 font-bold mb-2">Gambar (URL)</label>
                        <input type="url" name="image" 
                               class="w-full border rounded-lg px-3 py-2" 
                               placeholder="https://example.com/gambar.jpg" value="{{ old('image') }}">
                    </div>

                    <div class="flex justify-between">
                        <a href="{{ route('admin.products.index') }}" class="bg-gray-500 text-white px-4 py-2 rounded-lg">Batal</a>
                        <button type="submit" class="bg-green-600 text-white px-4 py-2 rounded-lg">Simpan</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
@endsection