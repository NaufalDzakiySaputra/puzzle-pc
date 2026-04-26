@extends('layouts.app')

@section('content')
<div class="container py-5">
    <div class="row mb-4">
        <div class="col-12 d-flex justify-content-between align-items-center">
            <h1 class="fw-bold" style="background: var(--accent-gradient); -webkit-background-clip: text; background-clip: text; color: transparent;">
                📦 MANAGE PRODUCTS
            </h1>
            <a href="{{ route('admin.products.create') }}" class="btn btn-neon">
                <i class="fas fa-plus me-2"></i>ADD PRODUCT
            </a>
        </div>
    </div>

    @if(session('success'))
        <div class="alert alert-success mb-4">{{ session('success') }}</div>
    @endif

    @if($products->isEmpty())
        <div class="product-card text-center py-5">
            <i class="fas fa-box-open fa-4x text-secondary mb-3"></i>
            <p class="text-secondary">Belum ada produk. Silakan tambah produk baru.</p>
        </div>
    @else
        <div class="product-card overflow-hidden">
            <div class="table-responsive">
                <table class="table table-borderless align-middle mb-0">
                    <thead style="background: var(--bg-secondary);">
                        <tr>
                            <th class="px-3 py-3">ID</th>
                            <th class="px-3 py-3">Image</th>
                            <th class="px-3 py-3">Product Name</th>
                            <th class="px-3 py-3">Category</th>
                            <th class="px-3 py-3">Price</th>
                            <th class="px-3 py-3">Stock</th>
                            <th class="px-3 py-3 text-center">Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($products as $product)
                        <tr class="border-bottom" style="border-color: var(--border-color);">
                            <td class="px-3 py-3">{{ $product->id }}</td>
                            <td class="px-3 py-3">
                                @if($product->image)
                                    <img src="{{ asset('storage/' . $product->image) }}" 
                                         alt="{{ $product->name }}" 
                                         style="width: 50px; height: 50px; object-fit: cover;">
                                @else
                                    <i class="fas fa-microchip fa-2x text-secondary"></i>
                                @endif
                            </td>
                            <td class="px-3 py-3 fw-bold">{{ $product->name }}</td>
                            <td class="px-3 py-3">{{ $product->category ?? '-' }}</td>
                            <td class="px-3 py-3 price-tag">Rp {{ number_format($product->price, 0, ',', '.') }}</td>
                            <td class="px-3 py-3">
                                <span class="badge {{ $product->stock > 0 ? 'bg-success' : 'bg-danger' }}" style="border-radius: 0px;">
                                    {{ $product->stock }}
                                </span>
                            </td>
                            <td class="px-3 py-3">
                                <div class="d-flex gap-2">
                                    <!-- Tombol Edit -->
                                    <a href="{{ route('admin.products.edit', $product) }}" 
                                       class="btn btn-outline-neon btn-sm px-3 py-1">
                                        <i class="fas fa-edit me-1"></i> Edit
                                    </a>
                                    
                                    <!-- Tombol Hapus -->
                                    <form action="{{ route('admin.products.destroy', $product) }}" method="POST" class="d-inline">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" 
                                                class="btn btn-outline-neon btn-sm px-3 py-1" 
                                                style="border-color: #dc3545; color: #dc3545;"
                                                onclick="return confirm('Yakin hapus produk {{ $product->name }}?')">
                                            <i class="fas fa-trash me-1"></i> Hapus
                                        </button>
                                    </form>
                                </div>
                            </td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
        
        <div class="row mt-4">
            <div class="col-12">
                {{ $products->links('pagination::bootstrap-5') }}
            </div>
        </div>
    @endif
</div>
@endsection