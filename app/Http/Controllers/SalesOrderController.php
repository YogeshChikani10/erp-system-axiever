<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\SalesOrder;
use App\Models\Product;
use App\Services\SalesOrderService;
use Barryvdh\DomPDF\Facade\Pdf;

class SalesOrderController extends Controller
{
    
    // Sales order listing.
    public function index(){
        
        $orders = SalesOrder::with('user')->latest()->paginate(10);
        return view('sales_orders.index', compact('orders'));
    }

    // Create salesorder page.
    public function create(){

        $products = Product::select('id', 'name', 'price')->get();
        return view('sales_orders.create', compact('products'));
    }

    // Save order with order itemlines
    public function store(Request $request){
        
        $request->validate([
            'customer_name'         => 'required|string|max:255',
            'products.*.product_id' => 'required|exists:products,id',
            'products.*.quantity'   => 'required|integer|min:1',
        ]);
        
        try {

            SalesOrderService::createOrder(
                auth()->id(),
                $request->customer_name,
                $request->products
            );

            return redirect()->route('sales-orders.index')->with('success', 'Sales order created successfully.');

        } catch (\Exception $e) {

            return back()->withErrors(['error' => $e->getMessage()])->withInput();
        }
    }

    // View sales order details.
    public function show($id){
        
        $order = SalesOrder::with('items.product')->findOrFail($id);
        return view('sales_orders.show', compact('order'));
    }

    // Download pdf.
    public function downloadPdf($id){
    
        $order = SalesOrder::with('items.product')->findOrFail($id);
        $pdf   = Pdf::loadView('sales_orders.pdf', compact('order'));
        return $pdf->download("sales_order_{$order->id}.pdf");
    }
}
