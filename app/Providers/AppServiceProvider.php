<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Facades\View;
use Illuminate\Support\Facades\Auth;
use App\Models\Cart_Item;
use App\Models\Category;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
        //
    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
        View::composer('layout.header', function ($view) {
            $user = Auth::user();
            $cartItems = collect();

            if ($user) {
                $cartItems = Cart_Item::with(['product.category_pro'])
                    ->whereHas('cart', function ($query) use ($user) {
                        $query->where('user_id', $user->id);
                    })->get();
            }
            $categories = Category::all();

            $view->with([
                'cartItems' => $cartItems,
                'categories' => $categories
            ]);
        });
    }
}
