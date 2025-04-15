<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use App\Models\User;
use App\Models\Cart_Item;

class Cart extends Model
{   
    protected $table = "carts";
    protected $fillable = ['user_id'];
    public function user(){
        return $this->belongsTo(User::class, 'user_id', 'id');
    }

    public function cart_items(){
        return $this->hasMany(Cart_Item::class, 'cart_id', 'id');
    }
}
