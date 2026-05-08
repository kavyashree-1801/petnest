<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class OrderItem extends Model
{
    protected $fillable = [
    'order_id',
    'product_name', // 🔥 ADD THIS
    'price',
    'quantity'
];

   public function product()
{
    return $this->belongsTo(Product::class);
}

    // Relation to Order
    public function order()
    {
        return $this->belongsTo(Order::class);
    }
}