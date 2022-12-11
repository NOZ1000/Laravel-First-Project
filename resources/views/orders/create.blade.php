@extends('layouts.app')

@section('title')
Index @endsection


@section('content')
    <h1>Order Details</h1>

    <h4 class="text-center">Grand Total: <strong>${{ $cart->total }}</strong></h4>
    
    <div class="text-center mb-3">

        <form method="POST" 
            action="{{ route('orders.store') }}" 
            class="d-inline-flex">
            @csrf
        
            <button class="btn btn-success" type="submit">Confirm Order</button>
        </form>
    </div>

    <div class="table-responsive">
        <table class="table table-striped">
            <thead class="thead-light">
                <th>Product</th>
                <th>Price</th>
                <th>Quantity</th>
                <th>Total</th>
            </thead>
            <tbody>
                @foreach ($cart->products as $product)
                    <tr>
                        <td>
                            <img src="{{ asset($product->images->first()->path) }}" width="100">
                            {{ $product->title }}
                        </td>
                        <td>{{ $product->price }}</td>
                        <td>{{ $product->pivot->quantity }}</td>
                        <td>${{ $product->total }}</td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>

@endsection