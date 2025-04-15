<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use App\Models\User;
use App\Models\Product;

class Comment extends Model
{
    public function user_com(){
        return $this->belongsTo(User::class, 'user_id', 'id');
    }

    public function product_com(){
        return $this->belongsTo(Product::class, 'product_id', 'id');
    }

}
