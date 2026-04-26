@extends('layouts.app')

@section('content')
<div class="container py-5">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="product-card p-4">
                <h1 class="fw-bold mb-4" style="background: var(--accent-gradient); -webkit-background-clip: text; background-clip: text; color: transparent;">
                    <i class="fas fa-plus me-2"></i>ADD NEW PRODUCT
                </h1>

                <form action="{{ route('admin.products.store') }}" method="POST" enctype="multipart/form-data">
                    @csrf
                    
                    <div class="mb-3">
                        <label class="form-label fw-bold">Product Name</label>
                        <input type="text" name="name" required 
                               class="form-control @error('name') is-invalid @enderror"
                               value="{{ old('name') }}" placeholder="e.g., NVIDIA RTX 5090">
                        @error('name') <div class="invalid-feedback">{{ $message }}</div> @enderror
                    </div>

                    <div class="mb-3">
                        <label class="form-label fw-bold">Category</label>
                        <select name="category" class="form-select">
                            <option value="">Select Category</option>
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

                    <div class="mb-3">
                        <label class="form-label fw-bold">Description</label>
                        <textarea name="description" rows="4" 
                                  class="form-control">{{ old('description') }}</textarea>
                    </div>

                    <div class="row mb-3">
                        <div class="col-md-6">
                            <label class="form-label fw-bold">Price (Rp)</label>
                            <input type="number" name="price" required 
                                   class="form-control @error('price') is-invalid @enderror" 
                                   value="{{ old('price') }}" placeholder="e.g., 5000000">
                            @error('price') <div class="invalid-feedback">{{ $message }}</div> @enderror
                        </div>
                        <div class="col-md-6">
                            <label class="form-label fw-bold">Stock</label>
                            <input type="number" name="stock" required 
                                   class="form-control @error('stock') is-invalid @enderror" 
                                   value="{{ old('stock') }}" placeholder="e.g., 10">
                            @error('stock') <div class="invalid-feedback">{{ $message }}</div> @enderror
                        </div>
                    </div>

                    <div class="mb-4">
                        <label class="form-label fw-bold">Product Image</label>
                        <input type="file" name="image" accept="image/jpeg,image/png,image/jpg"
                               class="form-control @error('image') is-invalid @enderror">
                        <small class="text-secondary">Format: JPG, JPEG, PNG (Max 2MB)</small>
                        @error('image') <div class="invalid-feedback">{{ $message }}</div> @enderror
                    </div>

                    <div class="d-flex justify-content-between gap-3">
                        <a href="{{ route('admin.products.index') }}" class="btn btn-outline-neon flex-grow-1 text-center">
                            <i class="fas fa-arrow-left me-1"></i> CANCEL
                        </a>
                        <button type="submit" class="btn btn-neon flex-grow-1">
                            <i class="fas fa-save me-1"></i> SAVE PRODUCT
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
@endsection