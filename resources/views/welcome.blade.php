@extends('layouts.app')
@section('title')
Welcome @endsection

@section('content')
    @if (empty($products))
        <div class="alert alert-warning">The list of products is emty</div>
    @else
        <div class="row">
            @foreach ($products as $product)
                <div class="col-3">
                    @include('components.product-card')
                </div>
            @endforeach
        </div>
    @endif

@endsection