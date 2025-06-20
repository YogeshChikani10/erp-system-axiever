@extends('layouts.app')

@section('content')
<div class="container py-4">
    <h3 class="fw-bold text-primary mb-4">🧾 Create Sales Order</h3>

    {{-- Error display --}}
    @if($errors->any())
        <div class="alert alert-danger">
            <strong>Whoops!</strong> Please fix the following:
            <ul class="mt-2 mb-0">
                @foreach($errors->all() as $err)
                    <li>{{ $err }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    <form action="{{ route('sales-orders.store') }}" method="POST">
        @csrf

        {{-- Customer Name --}}
        <div class="mb-3">
            <label for="customer_name" class="form-label">Customer Name</label>
            <input type="text" name="customer_name" id="customer_name"
                   class="form-control @error('customer_name') is-invalid @enderror"
                   value="{{ old('customer_name') }}" required>
            @error('customer_name')
                <div class="invalid-feedback">{{ $message }}</div>
            @enderror
        </div>

        <hr>
        <h5 class="mb-3">Order Items</h5>

        <table class="table table-bordered align-middle text-center" id="itemTable">
            <thead class="table-light">
                <tr>
                    <th style="width: 30%">Product</th>
                    <th style="width: 10%">Price</th>
                    <th style="width: 10%">Qty</th>
                    <th style="width: 15%">Line Total</th>
                    <th style="width: 10%">Action</th>
                </tr>
            </thead>
            <tbody id="itemBody"></tbody>
        </table>

        <button type="button" class="btn btn-outline-secondary" onclick="addRow()">
            <i class="bi bi-plus-circle"></i> Add Item
        </button>

        <div class="mt-4 text-end">
            <h5>Total Amount: ₹<span id="grandTotal">0.00</span></h5>
        </div>

        <div class="text-end mt-3">
            <button type="submit" class="btn btn-primary px-4">
                <i class="bi bi-save"></i> Submit Order
            </button>
        </div>
    </form>
</div>
@endsection

@section('links')
    {{-- select2 CSS --}}
    <link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css" rel="stylesheet" />
@endsection

@section('scripts')
    {{-- jQuery + select2 --}}
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>

    {{-- Pass data to JS --}}
    <script>
        window.salesOrderProducts = @json($products);
        window.salesOrderProducts = @json($products);

        // Reformatted old input for JS
        window.oldProducts = [
            @foreach(old('products', []) as $product)
                {
                    product_id: '{{ $product['product_id'] ?? '' }}',
                    quantity: '{{ $product['quantity'] ?? 1 }}'
                },
            @endforeach
        ];
    </script>

    {{-- Custom JS --}}
    <script src="{{ asset('js/sales-order-form.js') }}"></script>
@endsection
