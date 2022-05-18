@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-12">
            <div class="card pb-2">
                <div class="card-header">Su carrito de compras</div>
                @if ($shoppingCars->count() == 0)
                <div class="m-3">
                    Actualmente no tiene productos en su carrito
                </div>
                @endif
                @foreach ($shoppingCars as $shoppingCar)
                <div class="m-3">
                    <div class="cardProduct row align-items-start" style="flex-wrap: inherit;">
                        <div class="col-6">
                            <div class="card__bodyProduct">
                                {{$shoppingCar->product->name}}
                            </div>
                        </div>
                        <div class="col-3">
                            <strong class=> 
                                ${{$shoppingCar->product->precio}}
                            </strong>
                        </div>
                        <div class="col-3">
                            <div class="icon">
                                <div hidden> {{$url = $shoppingCar->product->path}}</div>
                                
                                <img src="{{asset("$url")}}" alt="Image" width="40%">
                            </div>
                        </div>
                        <button><span id="{{$shoppingCar->id}}" name="{{$shoppingCar->product->id}}" class="productShoppingCar">Eliminar <i class="fas fa-trash-alt"></i></span></button>
                        
                    </div>
                </div>
                @endforeach
            </div>
            <div class="card">
                <button type="button" id="saveShopping" class="btn btn-success btn-lg btn-block">Finalizar Compra</button>
            </div>
        </div>
    </div>
</div>
@endsection

@section('scripts')
<script type="text/javascript" src="{{asset('js/shoppingCar.js')}}"></script>
<link type="text/css" rel="stylesheet" href="{{asset('css/shoppingCar.css')}}">
@endsection