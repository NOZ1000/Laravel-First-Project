<?php

namespace App\Services;

use Illuminate\Support\Facades\Cookie;
use App\Cart;

class CartService
{
    public function getFromCookieOrCreate()
    {
        $cartId = Cookie::get('cart');

        $cart = Cart::find($cartId);

        return $cart ?? Cart::create();
    }
}