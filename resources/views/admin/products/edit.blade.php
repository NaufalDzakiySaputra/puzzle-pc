@extends('layouts.app')

@section('content')
<div class="container py-5">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="product-card p-4">
                <h1 class="fw-bold mb-4" style="background: var(--accent-gradient); -webkit-background-clip: text; background-clip: text; color: transparent;">
                    <i class="fas fa-edit me-2"></i>EDIT PRODUCT
                </h1>

                <form action="{{ route('admin.products.update', $product) }}" method="POST" enctype="multipart/form-data">
                    @csrf
                    @method('PUT')
                    
                    <div class="mb-3">
                        <label class="form-label fw-bold">Product Name</label>
                        <input type="text" name="name" required 
                               class="form-control @error('name') is-invalid @enderror"
                               value="{{ old('name', $product->name) }}">
                        @error('name') <div class="invalid-feedback">{{ $message }}</div> @enderror
                    </div>

                    <div class="mb-3">
                        <label class="form-label fw-bold">Category</label>
                        <select name="category" class="form-select">
                            <option value="">Select Category</option>
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

                    <div class="mb-3">
                        <label class="form-label fw-bold">Description</label>
                        <textarea name="description" rows="4" 
                                  class="form-control">{{ old('description', $product->description) }}</textarea>
                    </div>

                    <div class="row mb-3">
                        <div class="col-md-6">
                            <label class="form-label fw-bold">Price (Rp)</label>
                            <input type="number" name="price" required 
                                   class="form-control @error('price') is-invalid @enderror" 
                                   value="{{ old('price', $product->price) }}">
                            @error('price') <div class="invalid-feedback">{{ $message }}</div> @enderror
                        </div>
                        <div class="col-md-6">
                            <label class="form-label fw-bold">Stock</label>
                            <input type="number" name="stock" required 
                                   class="form-control @error('stock') is-invalid @enderror" 
                                   value="{{ old('stock', $product->stock) }}">
                            @error('stock') <div class="invalid-feedback">{{ $message }}</div> @enderror
                        </div>
                    </div>

                    <div class="mb-4">
                        <label class="form-label fw-bold">Product Image</label>
                        
                        @if($product->image)
                            <div class="mb-2">
                                <img src="{{ asset('storage/' . $product->image) }}" alt="{{ $product->name }}" 
                                     style="width: 100px; height: 100px; object-fit: cover;">
                                <p class="text-secondary small mt-1">Current image</p>
                            </div>
                        @endif
                        
                        <input type="file" name="image" accept="image/jpeg,image/png,image/jpg"
                               class="form-control @error('image') is-invalid @enderror">
                        <small class="text-secondary">Leave empty to keep current image. Format: JPG, JPEG, PNG (Max 2MB)</small>
                        @error('image') <div class="invalid-feedback">{{ $message }}</div> @enderror
                    </div>

                    <div class="d-flex justify-content-between gap-3">
                        <a href="{{ route('admin.products.index') }}" class="btn btn-outline-neon flex-grow-1 text-center">
                            <i class="fas fa-arrow-left me-1"></i> CANCEL
                        </a>
                        <button type="submit" class="btn btn-neon flex-grow-1">
                            <i class="fas fa-save me-1"></i> UPDATE PRODUCT
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
@endsection