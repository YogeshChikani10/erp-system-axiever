@extends('layouts.app')

@section('content')
<div class="container py-4">
    <h4 class="fw-bold text-warning mb-4">✏️ Edit Product</h4>

    @include('products._form', [
        'action' => route('products.update', $product),
        'method' => 'PUT',
        'product' => $product,
        'buttonText' => 'Update Product'
    ])
</div>
@endsection
