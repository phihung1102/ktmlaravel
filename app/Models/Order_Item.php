<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use App\Models\Order;
use App\Models\Product;

class Order_Item extends Model
{   
    protected $table = "order_items";
    protected $fillable = [
        'order_id', 'product_id', 'quantity', 'price',
    ];
    public function order(){
        return $this->belongsTo(Order::class, 'order_id', 'id');
    }

    public function product_od(){
        return $this->belongsTo(Product::class, 'product_id', 'id');
    }
}
