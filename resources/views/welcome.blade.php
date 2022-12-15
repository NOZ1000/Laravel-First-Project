@extends('layouts.app')
@section('title')
Welcome @endsection

@section('content')
    @if (empty($products))
        <div class="alert alert-warning">The list of products is emty</div>
    @else
        <div class="row">
            {{-- @dump($products) --}}
            @foreach ($products as $product)
                <div class="col-3">
                    @include('components.product-card')
                </div>
            @endforeach

            {{-- @dump($products) --}}
            {{-- @dd(\DB::getQueryLog()) --}}
        </div>
    @endif

@endsection