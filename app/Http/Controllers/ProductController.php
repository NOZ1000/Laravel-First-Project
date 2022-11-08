<?php

namespace App\Http\Controllers;

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

    public function store() {
        $rules = [
            'title' => ['required', 'max:255'],
            'description' => ['required', 'max:1000'],
            'price' => ['required', 'min:1'],
            'stock' => ['required', 'min:0'],
            'status' => ['required', 'in:available,unavailable'],
        ];
        request()->validate($rules);

        if (request()->stock == 0 && request()->status == 'available') {
            
            return redirect()->back()->withInput(request()->all())->withErrors('Status can not be available when stock is 0');
        }
        
        $product = Product::create(request()->all());


        return redirect()
            ->route('products.index')
            ->with(['success' => "New product with id {$product->id} was created succesfully"]);
        }

    public function show(Product $product) {
        return view('products.show')->with([
            'product' => $product
        ]);
    }

    public function edit($product) {
        $product = Product::findOrFail($product);
        return view('products.edit')->with([
            'product' => $product
        ]);
    }
    public function update(Product $product) {
        $rules = [
            'title' => ['required', 'max:255'],
            'description' => ['required', 'max:1000'],
            'price' => ['required', 'min:1'],
            'stock' => ['required', 'min:0'],
            'status' => ['required', 'in:available,unavailable'],
        ];
        request()->validate($rules);

        if (request()->stock == 0 && request()->status == 'available') {

            return redirect()
                ->back()
                ->withInput(request()->all())
                ->withErrors('Status can not be available when stock is 0');
        }


        $product->update(request()->all());

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
