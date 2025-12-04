<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Product extends Model
{
   protected $fillable = [
        'name',
        'description',
        'type',
        'price',
        'stock',
    ];

    public function orders(){
        return $this->belongsToMany(Order::class, 'order_items')
        ->withPivot('quantity','price','subtotal')
        ->withTimestamps();

    }

}
