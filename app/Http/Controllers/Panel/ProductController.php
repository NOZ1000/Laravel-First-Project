<?php

namespace App\Http\Controllers\Panel;

use App\Http\Requests\ProductRequest;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Image;
// use Illuminate\Support\Facades\DB;
use App\PanelProduct;
use Illuminate\Support\Facades\File;
use App\Scopes\AvailableScope;
use Illuminate\Support\Facades\DB;

class ProductController extends Controller
{   
    // public function __construct()
    // {
    //     $this->middleware('auth')->except(['index', 'show']);
    // }

    public function index() {
        // DB::connection()->enableQueryLog();
        $products = PanelProduct::without('images')->get();

        return view('products.index')->with([
            'products' => $products,
        ]);
    }

    public function create() {
        return view('products.create');
    }

    public function store(ProductRequest $request) {
        $product = PanelProduct::create($request->validated());
        
        foreach ($request->images as $image ) {
            $product->images()->create([
                'path' => 'images/' . $image->store('products', 'images')]);
        }

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

        if ($request->hasFile('images')) {
            foreach ($product->images as $image ) {
                $path = storage_path("app/public/{$image->path}");
                File::delete($path);
                $image->delete();
            }
            
            foreach ($request->images as $image ) {
                $product->images()->create([
                    'path' => 'images/' . $image->store('products', 'images')]);
            }
    
        }

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
