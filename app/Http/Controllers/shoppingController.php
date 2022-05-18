<?php

namespace App\Http\Controllers;

use App\Models\products;
use App\Models\shopping;
use App\Models\shopping_cars;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Mail;
use App\Mail\shoppingMail;

class shoppingController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }


    public function addProductShoppingCar($idProduct){
        $data=[
            'error'=>'on',
            'mensaje'=>'Error al agregar al Carrito',
        ];
        if(shopping_cars::where('id_user', Auth::user()->id)->where('id_products', $idProduct)->count()>0){
            $data['mensaje'] = "Ya tienes este producto en el carrito";
            return response()->json($data,200);
        }
        $shoppingCar = new shopping_cars();
        $shoppingCar->id_user = Auth::user()->id;
        $shoppingCar->id_products = $idProduct;
        if($shoppingCar->save()){
            $data=[
                'error'=>'off',
                'mensaje'=>'Agregado al Carrito',
            ];
        }
        return response()->json($data,200);
    }

    public function index(){
        $shoppingCars = shopping_cars::where("id_user", Auth::user()->id)->get();
        return view('shoppingCar', compact('shoppingCars'));
    }

    public function deleteProductShoppingCar($idShoppingCar){
        $data=[
            'error'=>'on',
            'mensaje'=>'Error al borrar el producto del carrito',
        ];
        $shoppingCar = shopping_cars::find($idShoppingCar);
        if($shoppingCar->delete()){
            $data = [
                'error'=>'off',
                'mensaje'=>'Producto borrado correctamente'
            ];
        }
        return response()->json($data,200);
    }

    public function saveShopping(Request $request){
        $idUser = Auth::user()->id;
        $shopping = shopping::select('N_compra')->where('id_user', $idUser);
        $numSerie = 1;
        if($shopping->count() != 0){
            $numSerie = $shopping->max('N_compra')+1;
        }
        foreach($request->products as $product){
            $shopping = new shopping();
            $shopping->id_user = $idUser;
            $shopping->id_products = $product;
            $shopping->N_compra = $numSerie;
            $shopping->dateShopping = date('Y-m-d', time());;
            $shopping->save();
        }
        $shoppingList = shopping_cars::where('id_user', $idUser);
        Mail::to(Auth::user()->email)
            ->send(new shoppingMail($shoppingList->get()));
        $shoppingList->delete();
        $data = [
            'error'=>'off',
            'mensaje'=>'Productos Registrados correctamente'
        ];
        return response()->json($data,200);
    }
}
