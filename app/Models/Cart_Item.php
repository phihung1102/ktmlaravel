<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Cart_Item extends Model
{
    protected $table = "cart_items";
    protected $fillable = ['cart_id', 'product_id', 'quantity', 'price_at_time'];
    public function cart(){
        return $this->belongsTo(Cart::class, 'cart_id', 'id');
    }
    public function product(){
        return $this->belongsTo(Product::class, 'product_id', 'id');
    }
}
