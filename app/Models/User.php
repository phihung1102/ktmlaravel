<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use App\Models\Cart;
use App\Models\Order;
use App\Models\Like;
use App\Models\Comment;
use Illuminate\Notifications\Notifiable;
use Illuminate\Foundation\Auth\User as Authenticatable;

class User extends Authenticatable
{   
    protected $table = "users";
    use Notifiable;
    protected $fillable = ['username', 'email', 'address', 'role', 'phone',];


    public function cart(){
        return $this->hasOne(Cart::class, 'user_id', 'id');
    }

    public function orders(){
        return $this->hasMany(Order::class, 'user_id', 'id');
    }

    public function likes(){
        return $this->hasMany(Like::class, 'user_id', 'id');
    }

    public function comments(){
        return $this->hasMany(Comment::class, 'user_id', 'id');
    }

    public function favorites()
    {
        return $this->hasMany(Favorite::class, 'user_id', 'id');
    }

}
