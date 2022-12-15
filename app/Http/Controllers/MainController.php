<?php

namespace App\Http\Controllers;

use App\Product;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;


class MainController extends Controller
{
    public function index()
    {
        // DB::connection()->enableQueryLog();

        // $products = Product::where('status', 'available')->get();
        // $products = Product::available()->get();
        $products = Product::all();

        return view('welcome')->with([
            'products' => $products,
        ]);
    }
}
