<?php

namespace App\Http\Controllers;

use App\Cart;
use Illuminate\Support\Facades\Cookie;
use App\Http\Requests\StoreCartRequest;
use App\Http\Requests\UpdateCartRequest;
use App\Services\CartService;

class CartController extends Controller
{   
    public $cartService;

    public function __construct(CartService $cartService) 
    {
        $this->cartService = $cartService;
    }


    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $cart = $this->cartService->getFromCookie();

        return view('carts.index')->with([
            'cart' => $cart,
        ]);
    }

}
