<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Order_items extends Model
{
    protected $fillable = [
        'order_id',
        'product_id',
        'quantity',
        'price',
        'subtotal'
    ];

    public function order(){
        return $this->belongsTo(Order::class);
    }

    public function product(){
        return $this->belongsTo((Product::class));
    }

    public function calculateSubtotal(){
        $this->subtotal = $this->quantity * $this->price;
        return $this->subtotal;
    }
}
