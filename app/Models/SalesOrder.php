<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class SalesOrder extends Model
{
    
    protected $fillable = ['user_id', 'customer_name', 'total_amount'];

    // Relationship with itemline
    public function items(){
        return $this->hasMany(SalesOrderItem::class);
    }

    // Relationship with user
    public function user(){
        return $this->belongsTo(User::class);
    }
}
