<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use App\Models\Order_Item;
use App\Models\User;

class Order extends Model
{   
    protected $table = "orders";
    protected $fillable = [
        'user_id', 'date_order', 'total_amount',
        'shipping_address', 'status', 'payment_method', 'payment_status',
    ];
    public function order_items(){
        return $this->hasMany(Order_Item::class, 'order_id', 'id');
    }

    public function user_od(){
        return $this->belongsTo(User::class, 'user_id', 'id');
    }
}
