@extends('layouts.app')

@section('title')
Show @endsection

@section('content')
    <div class="row justify-content-center">
        <div class="col-4">
            @include('components.product-card')
        </div>
    </div>
@endsection