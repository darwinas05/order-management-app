<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Order extends Model
{
     use HasFactory;
    protected $fillable = [
        'customer_name',
        'address',
        'phone',
        'note',
        'order_type',
        'table_number',
        'status',
        'employee_id',
        'total_price'
    ];


    public function employee(){
        return $this->belongsTo(Employee::class);
    }

    public function products(){
        return $this->belongsToMany(Product::class, 'order_items')
        ->withPivot('quantity','price', 'subtotal')->withTimestamps();
    }
    public function items(){
        return $this->hasMany(Order_items::class);
    }
}
