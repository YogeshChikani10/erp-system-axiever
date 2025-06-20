<?php
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Api\UserController;
use App\Http\Controllers\Api\ProductApiController;
use App\Http\Controllers\Api\SalesOrderApiController;

Route::post('/login', [UserController::class, 'login']);

Route::middleware('auth:api')->group(function () {
    
    Route::post('/logout', [UserController::class, 'logout']);

    // Products
    Route::get('/products', [ProductApiController::class, 'index']);
    
    // Sales orders
    Route::post('/sales-orders', [SalesOrderApiController::class, 'store']);
    Route::get('/sales-orders/{id}', [SalesOrderApiController::class, 'show']);
});
