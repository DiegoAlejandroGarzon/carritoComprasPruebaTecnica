<?php

namespace App\Http\Controllers;

use App\Http\Requests\userRequest;
use App\Http\Requests\userUpdateRequest;
use App\model_has_roles;
use App\roles;
use App\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class userController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function create(userRequest $request){
        $data=[
            'error'=>'on',
            'mensaje'=>'Error al guardar el usuario',
        ];
        $user = new User();
        $user->name = $request->name;
        $user->email = $request->email;
        $user->password = Hash::make($request->password);
        if($user->save()){
            $user->assignRole($request->role);
            $data=[
                'error'=>'off',
                'mensaje'=>'Usuario guardado con éxito',
            ];
        }
        return response()->json($data,200);
    }

    public function usersList(){
        $usuarios = User::all();
        $concatenaTabla=collect([]);
        foreach($usuarios as $usuario){
            if($usuario->id != 1){
                $roleDelUsuario = model_has_roles::where('model_id', $usuario->id)->first();
                $role = roles::find($roleDelUsuario->role_id);
            $collectionTabla = collect([
                [
                    'id'=>$usuario->id,
                    'name'=>$usuario->name,
                    'email'=>$usuario->email,
                    'role'=>$role->name,
                ]
            ]);
            $concatenaTabla = $collectionTabla->concat($concatenaTabla);
            }
        }
        return response()->json(['data'=>$concatenaTabla],200);
    }

    public function update(userUpdateRequest $request){
        $user = User::find($request->idUser);
        $user->name = $request->name;
        $user->email = $request->email;
        if($user->save()){
            if($request->roleActual != $request->role){
                $user->removeRole($request->roleActual);
                $user->assignRole($request->role);
            }
            $data=[
                'error'=>'off',
                'mensaje'=>'Usuario guardado con éxito',
            ];
            return response()->json($data,200);
        }
        $data=[
            'error'=>'on',
            'mensaje'=>'Error al guardar el usuario',
        ];
        return response()->json($data,200);
    }

    public function delete($id){
        $data=[
            'error'=>'on',
            'mensaje'=>'Error al borrar el usuario',
        ];
        $usuario = User::find($id);
        if($usuario->delete()){
            $data = [
                'error'=>'off',
                'mensaje'=>'Usuario borrado correctamente'
            ];
        }
        return response()->json($data,200);
    }
}
