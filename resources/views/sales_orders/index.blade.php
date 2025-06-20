@extends('layouts.app')

@section('content')
<div class="container py-4">
    
    <div class="d-flex justify-content-between align-items-center mb-4">
        <h3 class="fw-bold text-primary mb-4">📄 Sales Orders</h3>
        <a href="{{ route('sales-orders.create') }}" class="btn btn-success">
            <i class="bi bi-plus-circle"></i> Create Sales Order
        </a>
    </div>

    @if (session('success'))
        <div class="alert alert-success">{{ session('success') }}</div>
    @endif

    <table class="table table-bordered table-hover align-middle text-center">
        <thead class="table-light">
            <tr>
                <th>#</th>
                <th>Customer</th>
                <th>User</th>
                <th>Total (₹)</th>
                <th>Created</th>
                <th>Action</th>
            </tr>
        </thead>
        <tbody>
            @forelse ($orders as $order)
                <tr>
                    <td>{{ $order->id }}</td>
                    <td>{{ $order->customer_name }}</td>
                    <td>{{ $order->user->name ?? 'N/A' }}</td>
                    <td>{{ number_format($order->total_amount, 2) }}</td>
                    <td>{{ $order->created_at->format('d M Y') }}</td>
                    <td>
                        <a href="{{ route('sales-orders.show', $order->id) }}" class="btn btn-sm btn-info">
                            <i class="bi bi-eye"></i> View
                        </a>
                    </td>
                </tr>
            @empty
                <tr><td colspan="6" class="text-muted">No orders found.</td></tr>
            @endforelse
        </tbody>
    </table>

    <div class="d-flex justify-content-end">
        {{ $orders->links() }}
    </div>
</div>
@endsection
