<?php

namespace App\Http\Controllers;

use App\Http\Requests\ProductRequest;
use Illuminate\Http\Request;
// use Illuminate\Support\Facades\DB;
use App\Product;

class ProductController extends Controller
{   
    public function __construct()
    {
        $this->middleware('auth')->except(['index', 'show']);
    }

    public function index() {
        $products = Product::all();

        return view('products.index')->with([
            'products' => $products,
        ]);
    }

    public function create() {
        return view('products.create');
    }

    public function store(ProductRequest $request) {
        $product = Product::create($request->validated());

        return redirect()
            ->route('products.index')
            ->with(['success' => "New product with id {$product->id} was created succesfully"]);
    }

    public function show(Product $product) {
        return view('products.show')->with([
            'product' => $product
        ]);
    }

    public function edit(Product $product) {
        return view('products.edit')->with([
            'product' => $product
        ]);
    }

    public function update(ProductRequest $request, Product $product) {

        $product->update($request->validated());

        return redirect()
            ->route('products.index')
            ->withSuccess("New product with id {$product->id} was edited succesfully");
    }

    public function destroy(Product $product) {
        $product->delete();

        return redirect()
            ->route('products.index')
            ->withSuccess("New product with id {$product->id} was removed succesfully");
    }

}
