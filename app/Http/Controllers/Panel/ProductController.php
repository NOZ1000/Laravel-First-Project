<?php

namespace App\Http\Controllers\Panel;

use App\Http\Requests\ProductRequest;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
// use Illuminate\Support\Facades\DB;
use App\PanelProduct;
use App\Scopes\AvailableScope;

class ProductController extends Controller
{   
    // public function __construct()
    // {
    //     $this->middleware('auth')->except(['index', 'show']);
    // }

    public function index() {
        $products = PanelProduct::all();

        return view('products.index')->with([
            'products' => $products,
        ]);
    }

    public function create() {
        return view('products.create');
    }

    public function store(ProductRequest $request) {
        $product = PanelProduct::create($request->validated());

        return redirect()
            ->route('products.index')
            ->with(['success' => "New product with id {$product->id} was created succesfully"]);
    }

    public function show(PanelProduct $product) {
        return view('products.show')->with([
            'product' => $product
        ]);
    }

    public function edit(PanelProduct $product) {
        return view('products.edit')->with([
            'product' => $product
        ]);
    }

    public function update(ProductRequest $request, PanelProduct $product) {

        $product->update($request->validated());

        return redirect()
            ->route('products.index')
            ->withSuccess("New product with id {$product->id} was edited succesfully");
    }

    public function destroy(PanelProduct $product) {
        $product->delete();

        return redirect()
            ->route('products.index')
            ->withSuccess("New product with id {$product->id} was removed succesfully");
    }

}
