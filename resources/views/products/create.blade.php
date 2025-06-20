@extends('layouts.app')

@section('content')
<div class="container py-4">
    <h4 class="fw-bold text-success mb-4">➕ Add New Product</h4>

    @include('products._form', [
        'action' => route('products.store'),
        'method' => 'POST',
        'product' => null,
        'buttonText' => 'Create Product'
    ])
</div>
@endsection
