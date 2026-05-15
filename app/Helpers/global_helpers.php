<?php

use App\Models\Cart;
use Illuminate\Support\Facades\Auth;

if (!function_exists('setActive')) {
    function setActive(array $routes, $activeClass = 'active'): string
    {
        return request()->routeIs($routes) ? $activeClass : '';
    }
}

if (!function_exists('user')) {
    /**
     * @return \App\Models\User|null
     */
    function user()
    {
        return Auth::user();
    }
}

if (!function_exists('cartTotal')) {
    function cartTotal() {
        $total = 0;

        $cart = Cart::where('user_id', user()->id)->get();

        foreach($cart as $item) {
            if($item->course->discount > 0) {
                $total += $item->course->discount;
            } else {
                $total += $item->course->price;
            }
        }

        return $total;
    }
}

/** get cart total */
if (!function_exists('cartCount')) {
    function cartCount(): int
    {
        return Cart::where('user_id', user()?->id)->count();
    }
}
