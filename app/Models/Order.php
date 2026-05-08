<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use App\Models\OrderItem;

class Order extends Model
{
    protected $fillable = [
    'user_id',
    'name',
    'email',
    'phone',
    'address',
    'total',
    'status',
    'tracking_id', // 🔥 ADD THIS
    'delivery_status',
    'delivery_date',
];

    public function items()
{
    return $this->hasMany(OrderItem::class);
}

    public function user()
{
    return $this->belongsTo(User::class);
}
}
