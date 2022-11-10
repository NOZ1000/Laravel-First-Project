<?php

namespace App\Services;

use Illuminate\Support\Facades\Cookie;
use App\Cart;

class CartService
{   
    protected $cookieName = 'cart';

    public function getFromCookieOrCreate()
    {
        $cartId = Cookie::get($this->cookieName);

        $cart = Cart::find($cartId);

        return $cart ?? Cart::create();
    }

    public function makeCookie(Cart $cart) 
    {
        return Cookie::make($this->cookieName, $cart->id, 7 * 24 * 60);  
    }
}