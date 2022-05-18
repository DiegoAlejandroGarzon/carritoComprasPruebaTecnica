@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="">
            <div class="card pb-5">
                <div class="card-header">Lista de Productos</div>
                <div id="productSpace" class="row">
                @foreach ($products as $product)
                <div class="cardProduct m-5 col-3">
                    <div class="card-imgProduct"><img src="{{asset("$product->path")}}" alt="Image" width="100%" height="100%"></div>
                    <div class="card-infoProduct">
                        <p class="text-title">{{$product->name}} </p>
                    </div>
                    <div class="card-footerProduct">
                        <span class="text-title">${{$product->precio}}</span>
                        <div class="card-buttonProduct" id="{{$product->id}}">
                            <i class="fas fa-shopping-cart" ></i>
                        </div>
                    </div>
                </div>
                @endforeach
                </div>
            </div>
        </div>
    </div>
</div>
@endsection

@section('scripts')
    <script type="text/javascript" src="{{asset('js/shopping.js')}}"></script>
    <link type="text/css" rel="stylesheet" href="{{asset('css/productCard.css')}}">
@endsection