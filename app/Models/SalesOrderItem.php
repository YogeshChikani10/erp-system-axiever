<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class SalesOrderItem extends Model
{
    //

    protected $fillable = ['sales_order_id', 'product_id', 'quantity', 'price', 'total'];

    // Relationship with salesOrder
    public function order(){
        return $this->belongsTo(SalesOrder::class, 'sales_order_id');
    }

    // Relationship with product
    public function product(){
        return $this->belongsTo(Product::class);
    }
}
