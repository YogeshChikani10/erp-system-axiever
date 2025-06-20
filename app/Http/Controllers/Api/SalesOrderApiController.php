<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Services\SalesOrderService;
use Illuminate\Support\Facades\Validator;
use App\Models\SalesOrder;

class SalesOrderApiController extends Controller
{
    protected $service;

    public function __construct(SalesOrderService $service){
        $this->service = $service;
    }

    // Save the order.
    public function store(Request $request){
        
        $validator = Validator::make($request->all(), [
            'customer_name'         => 'required|string|max:255',
            'products'              => 'required|array|min:1',
            'products.*.product_id' => 'required|exists:products,id',
            'products.*.quantity'   => 'required|integer|min:1',
        ]);

        if ($validator->fails()) {
            return response()->json([
                'status'  => false,
                'message' => 'Validation failed.',
                'data'    => $validator->errors()
            ], 422);
        }

        try {

            $order = $this->service->createOrder(auth()->id(),$request->customer_name,$request->products);

            return response()->json([
                'status'  => true,
                'message' => 'Sales order created successfully.',
                'data'    => $order
            ], 200);

        } catch (\Exception $e) {
            
            return response()->json([
                'status'  => false,
                'message' => $e->getMessage(),
                'data'    => []
            ], 422);
        }
    }

    // Details of sales orders.
    public function show($id){

        $order = SalesOrder::with('items.product')->find($id);

        if (!$order) {
            return response()->json([
                'status'  => false,
                'message' => 'Sales order not found.',
                'data'    => []
            ], 404);
        }

        return response()->json([
            'status'  => true,
            'message' => 'Sales order fetched successfully.',
            'data'    => $order
        ], 200);
    }
}
