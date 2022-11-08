<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
// use Illuminate\Support\Facades\DB;
use App\Product;

class ProductController extends Controller
{
    public function index() {
        // $products = DB::table('products')->get();
        $products = Product::all();
        // dd($products);
        return view('products.index')->with([
            'products' => $products,
        ]);
    }

    public function create() {
        return view('products.create');
    }

    public function store() {
        // dd(request()->title, request()->description, request()->all());
        // $product = Product::create([
        //     'title' => request()->title,
        //     'description' => request()->description,
        //     'price' => request()->price,
        //     'stock' => request()->stock,
        //     'status' => request()->status,
        // ]);

        $rules = [
            'title' => ['required', 'max:255'],
            'description' => ['required', 'max:1000'],
            'price' => ['required', 'min:1'],
            'stock' => ['required', 'min:0'],
            'status' => ['required', 'in:available,unavailable'],
        ];
        request()->validate($rules);

        if (request()->stock == 0 && request()->status == 'available') {
            // session()->flash('error', 'Status can not be available when stock is 0');
            
            return redirect()->back()->withInput(request()->all())->withErrors('Status can not be available when stock is 0');
        }
        
        $product = Product::create(request()->all());



        // session()->flash('success', "New product with id {$product->id} was created");
        return redirect()
            ->route('products.index')
            ->with(['success' => "New product with id {$product->id} was created succesfully"]);
        // return redirect()->route('products.index')->withSuccess("New product with id {$product->id} was created succesfully");
    }

    public function show($product) {
        // $product = DB::table('products')->where('id', $product)->get();
        // $product = Product::find($product);
        // $product = Product::where('id', $product)->get();
        // $product = Product::where('id', $product)->first();
        $product = Product::findOrFail($product);
        // dd($product);
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
    public function update($product) {
        $rules = [
            'title' => ['required', 'max:255'],
            'description' => ['required', 'max:1000'],
            'price' => ['required', 'min:1'],
            'stock' => ['required', 'min:0'],
            'status' => ['required', 'in:available,unavailable'],
        ];
        request()->validate($rules);

        if (request()->stock == 0 && request()->status == 'available') {
            // session()->flash('error', 'Status can not be available when stock is 0');

            return redirect()
                ->back()
                ->withInput(request()->all())
                ->withErrors('Status can not be available when stock is 0');
        }

        $product = Product::findOrFail($product);
        $product->update(request()->all());

        return redirect()
            ->route('products.index')
            ->withSuccess("New product with id {$product->id} was edited succesfully");

        
        // redirect()->action('ProductController@index');
    }
    public function destroy($product) {
        $product = Product::findOrFail($product);
        $product->delete();

        return redirect()
            ->route('products.index')
            ->withSuccess("New product with id {$product->id} was removed succesfully");
    }

}
