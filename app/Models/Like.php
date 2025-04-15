<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use App\Models\User;
use App\Models\Product;

class Like extends Model
{
    public function user_l(){
        return $this->belongsTo(User::class, 'user_id', 'id');
    }

    public function product_l(){
        return $this->belongsTo(Product::class, 'user_id', 'id');
    }
}
