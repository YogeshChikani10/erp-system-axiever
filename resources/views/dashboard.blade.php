@extends('layouts.app')

@section('content')
    <div class="container py-5">
        <h2 class="mb-4 text-primary fw-bold">Summary</h2>

        {{-- Summary Cards --}}
        <div class="row mb-4">
            <div class="col-md-4">
                <div class="card text-white bg-success mb-3">
                    <div class="card-body">
                        <h5 class="card-title">Total Sales</h5>
                        <p class="card-text fs-3">
                            ₹{{ number_format($totalSales, 2) }}
                        </p>
                    </div>
                </div>
            </div>
            <div class="col-md-4">
                <div class="card text-white bg-info mb-3">
                    <div class="card-body">
                        <h5 class="card-title">Total Orders</h5>
                        <p class="card-text fs-3">
                            {{ $totalOrders }}
                        </p>
                    </div>
                </div>
            </div>
            <div class="col-md-4">
                <div class="card text-white bg-danger mb-3">
                    <div class="card-body">
                        <h5 class="card-title">Low Stock Products</h5>
                        <p class="card-text fs-3">
                            {{ $lowStockCount }}
                        </p>
                    </div>
                </div>
            </div>
        </div>

        {{-- Low Stock Table --}}
        <div class="card">
            <div class="card-header bg-warning text-dark fw-semibold">
                ⚠ Low Stock Alerts
            </div>
            <div class="card-body p-0">
                <table class="table table-bordered mb-0">
                    <thead class="table-light">
                        <tr>
                            <th>#</th>
                            <th>Product Name</th>
                            <th>Quantity</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse($lowStockProducts as $index => $product)
                            <tr>
                                <td>{{ $index + 1 }}</td>
                                <td>{{ $product->name }}</td>
                                <td class="text-danger fw-bold">{{ $product->quantity }}</td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="3" class="text-muted text-center">No low stock products</td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </div>
    </div>
@endsection
