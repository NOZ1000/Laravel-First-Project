<div class="card">
    <img class="card-img-top" src="{{ asset($product->images()->first()->path) }}" height="500">
    <div class="card-body">
        <h4 class="text-right"><strong>${{ $product->price }}</strong></h4>
        <h5 class="card-title">{{$product->id}}. {{ $product->title }}</h5>
        <p class="card-text">{{ $product->description }}</p>
        <p class="card-text"><strong>{{ $product->stock}} left</strong></p>
        
        @if (isset($cart))
            <form method="POST" 
                action="{{ route('products.carts.destroy', ['product' => $product->id, 'cart' => $cart->id]) }}" 
                class="d-inline-flex">
            @csrf
            @method('DELETE')
            <button class="btn btn-warning" type="submit">Remove From Cart</button>
            </form>
            
        @else
            
            <form method="POST" 
            action="{{ route('products.carts.store', ['product' => $product->id]) }}" 
            class="d-inline-flex">
            @csrf
            
            <button class="btn btn-success" type="submit">Add to Cart</button>
        </form>
        @endif
    </div>
</div>
