@extends('layouts.app')

@section('title')
Index @endsection


@section('content')
    <h1>Payment Details</h1>

    <h4 class="text-center">Grand Total: <strong>${{ $order->total }}</strong></h4>
    
    <div class="text-center mb-3">

        <form method="POST" 
            action="{{ route('orders.payments.store', ['order' => $order->id]) }}" 
            class="d-inline-flex">
            @csrf
        
            <button class="btn btn-success" type="submit">Pay</button>
        </form>
    </div>
@endsection