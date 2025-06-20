<form action="{{ $action }}" method="POST" class="row g-3">
    @csrf
    @if($method === 'PUT') @method('PUT') @endif

    <div class="col-md-6">
        <label for="name" class="form-label">Product Name</label>
        <input type="text" name="name" id="name"
               value="{{ old('name', $product->name ?? '') }}"
               class="form-control @error('name') is-invalid @enderror" placeholder="e.g. Wireless Mouse" required>
        @error('name') <div class="invalid-feedback">{{ $message }}</div> @enderror
    </div>

    <div class="col-md-6">
        <label for="sku" class="form-label">SKU</label>
        <input type="text" name="sku" id="sku"
               value="{{ old('sku', $product->sku ?? '') }}"
               class="form-control @error('sku') is-invalid @enderror" placeholder="e.g. SKU001" required>
        @error('sku') <div class="invalid-feedback">{{ $message }}</div> @enderror
    </div>

    <div class="col-md-6">
        <label for="price" class="form-label">Price (₹)</label>
        <input type="number" name="price" id="price" step="0.01"
               value="{{ old('price', $product->price ?? '') }}"
               class="form-control @error('price') is-invalid @enderror" placeholder="e.g. 499.99" required>
        @error('price') <div class="invalid-feedback">{{ $message }}</div> @enderror
    </div>

    <div class="col-md-6">
        <label for="quantity" class="form-label">Quantity</label>
        <input type="number" name="quantity" id="quantity"
               value="{{ old('quantity', $product->quantity ?? '') }}"
               class="form-control @error('quantity') is-invalid @enderror" placeholder="e.g. 10" required>
        @error('quantity') <div class="invalid-feedback">{{ $message }}</div> @enderror
    </div>

    <div class="col-12 d-flex justify-content-between">
        <a href="{{ route('products.index') }}" class="btn btn-outline-secondary">
            <i class="bi bi-arrow-left"></i> Back
        </a>
        <button type="submit" class="btn btn-primary px-4">
            <i class="bi bi-check-circle"></i> {{ $buttonText }}
        </button>
    </div>
</form>
