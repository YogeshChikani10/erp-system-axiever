<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Product;

class ProductApiController extends Controller
{
    
    // Get the product list.
    public function index(){
        
        $products = Product::select('id', 'name', 'price', 'quantity')->get();

        if ($products->isEmpty()) {
            
            return response()->json([
                'status'  => false,
                'message' => 'No products available.',
                'data'    => []
            ], 201); // 201 with message
        }

        return response()->json([
            'status'  => true,
            'message' => 'Product list fetched successfully.',
            'data'    => $products
        ]);
    }
}
