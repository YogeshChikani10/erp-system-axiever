<?php

use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\SalesOrderController;
use App\Http\Controllers\DashboardController;

Route::get('/', function () {
    return redirect()->route('login');
});

// SalesOrder routes
Route::middleware(['auth'])->group(function () {
    Route::get('/sales-orders', [SalesOrderController::class, 'index'])->name('sales-orders.index');
    Route::get('/sales-orders/create', [SalesOrderController::class, 'create'])->name('sales-orders.create');
    Route::post('/sales-orders', [SalesOrderController::class, 'store'])->name('sales-orders.store');
    Route::get('/sales-orders/{id}', [SalesOrderController::class, 'show'])->name('sales-orders.show');
    Route::get('/sales-orders/{id}/pdf', [SalesOrderController::class, 'downloadPdf'])->name('sales-orders.pdf');
});

// Admin routes
Route::middleware(['auth', 'role:admin'])->group(function () {
    
    // Products
    Route::resource('products', ProductController::class);
    
    // Dashboard
    Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard');
});

require __DIR__.'/auth.php';
