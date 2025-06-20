@extends('layouts.app')

@section('content')
<div class="container py-4">
    <h3 class="fw-bold text-success mb-4">📄 Sales Order #{{ $order->id }}</h3>

    {{-- Basic Info --}}
    <div class="row mb-3">
        <div class="col-md-6">
            <h6>Customer Name:</h6>
            <p class="fw-semibold">{{ $order->customer_name }}</p>
        </div>
        <div class="col-md-6 text-md-end">
            <h6>Created On:</h6>
            <p>{{ $order->created_at->format('d M Y h:i A') }}</p>
        </div>
    </div>

    <div class="card shadow-sm mb-4">
        <div class="card-header bg-light">
            <strong>Order Items</strong>
        </div>
        <div class="card-body p-0">
            <table class="table table-bordered m-0">
                <thead class="table-light">
                    <tr>
                        <th>#</th>
                        <th>Product</th>
                        <th>Price (₹)</th>
                        <th>Quantity</th>
                        <th>Line Total (₹)</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($order->items as $index => $item)
                        <tr>
                            <td>{{ $index + 1 }}</td>
                            <td>{{ $item->product->name ?? 'N/A' }}</td>
                            <td>{{ number_format($item->price, 2) }}</td>
                            <td>{{ $item->quantity }}</td>
                            <td>{{ number_format($item->total, 2) }}</td>
                        </tr>
                    @endforeach
                </tbody>
                <tfoot>
                    <tr class="table-light">
                        <td colspan="4" class="text-end fw-bold">Total Amount:</td>
                        <td class="fw-bold">₹{{ number_format($order->total_amount, 2) }}</td>
                    </tr>
                </tfoot>
            </table>
        </div>
    </div>

    <div class="text-end">
        <a href="{{ route('sales-orders.index') }}" class="btn btn-secondary">
            <i class="bi bi-arrow-left"></i> Back to List
        </a>
        <a href="{{ route('sales-orders.pdf', $order->id) }}" class="btn btn-outline-dark">
            <i class="bi bi-file-earmark-pdf"></i> Export PDF
        </a>
    </div>
</div>
@endsection
