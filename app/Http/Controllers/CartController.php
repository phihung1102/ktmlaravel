<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Cart;
use App\Models\Cart_Item;
use App\Models\Product;
use Illuminate\Support\Facades\Auth;


class CartController extends Controller
{
    public function addToCart(Request $req){
        $validated = $req->validate([
            'product_id' => 'required|exists:products,id',
            'quantity' => 'required|integer|min:1',
            'price_at_time'=>'required|numeric', 
        ]);
        $user = Auth::user();
        if(!$user){
            return redirect()->route('login')->with('error', 'Bạn cần đăng nhập tài khoản để thêm sản phẩm vào giỏ hàng!!');
        }
        $cart = Cart::firstOrCreate(['user_id' => $user->id]);
        $cartItem = Cart_Item::where('cart_id', $cart->id)->where('product_id', $req->product_id)->first();
        if($cartItem){
            $cartItem->quantity += $req->quantity;
            $cartItem->save();
        }else{
            Cart_Item::create([
                'cart_id' => $cart->id,
                'product_id' => $req->product_id,
                'quantity' => $req->quantity,
                'price_at_time' => $req->price_at_time,
            ]);
        }
        return redirect()->back()->with('success', 'Đã thêm sản phẩm vào giỏ hàng!');
    }

    public function getCart(){
        $user = Auth::user();
        if(!$user){
            return redirect()->route('login')->with('error', 'Bạn cần phải dăng nhập!');
        }

        $cartItems = Cart_Item::with([
            'cart.user',
            'product.category_pro',
        ])->whereHas('cart', function($query) use ($user){
            $query->where('user_id', $user->id);
        })->get();

        return view('pages.cart', compact('cartItems'));
    }

    public function delCart($id){
        $cartItem = Cart_Item::findOrFail($id);
        $cartItem->delete();
        
        return redirect()->route('getCart')->with('success', 'Xoá thành công!');
    }
}
