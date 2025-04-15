<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use App\Models\Category;
use App\Models\Cart_Item;
use App\Models\Order_Item;
use App\Models\Like;
use App\Models\Comment;

class Product extends Model
{
    protected $table = "products";
    protected $fillable = ['name', 'description', 'price', 'sale_price', 'new', 'top', 'image', 'status', 'category_id'];
    public function category_pro(){
        return $this->belongsTo(Category::class, 'category_id', 'id');
    }

    public function cart_items_pro(){
        return $this->hasMany(Cart_Item::class, 'product_id', 'id');
    }

    public function orders_pro(){
        return $this->hasMany(Order_Item::class, 'product_id', 'id');
    }

    public function likes_pro(){
        return $this->hasMany(Like::class, 'product_id', 'id');
    }

    public function comments_pro(){
        return $this->hasMany(Comment::class, 'product_id', 'id');
    }
}
