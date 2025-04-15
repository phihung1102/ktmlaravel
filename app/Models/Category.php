<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use App\Models\Product;

class Category extends Model
{   
    protected $table = "categories";
    protected $fillable = ['name', 'description'];

    public function products(){
        return $this->hasMany(Product::class, 'cate_id', 'id');
    }
}
