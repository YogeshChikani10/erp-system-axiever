<?php
namespace App\Services;

use App\Models\Product;
use App\Models\SalesOrder;
use App\Models\SalesOrderItem;
use Illuminate\Support\Facades\DB;

class SalesOrderService
{
    public static function createOrder($userId, $customerName, $items){
        
        return DB::transaction(function () use ($userId, $customerName, $items) {
            
            $total = 0;

            foreach ( $items as $item ) {
                
                $product = Product::findOrFail($item['product_id']);

                if ($product->quantity < $item['quantity']) {
                    throw new \Exception("Insufficient stock for {$product->name}");
                }

                $total += $product->price * $item['quantity'];
                $product->decrement('quantity', $item['quantity']);
            }

            $order = SalesOrder::create([
                'user_id'       => $userId,
                'customer_name' => $customerName,
                'total_amount'  => $total,
            ]);

            foreach ( $items as $item ) {
                
                $product = Product::findOrFail($item['product_id']);
                
                SalesOrderItem::create([
                    'sales_order_id' => $order->id,
                    'product_id'     => $product->id,
                    'quantity'       => $item['quantity'],
                    'price'          => $product->price,
                    'total'          => $product->price * $item['quantity'],
                ]);
            }

            return $order;
        });
    }
}
