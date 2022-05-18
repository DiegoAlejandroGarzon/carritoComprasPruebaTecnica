<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class userRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'name'=>'required',
            'role'=>'required',
            'email'=>'required|email|unique:users,email',
            'password'=>'required|min:8',
        ];
    }

    public function messages(){
        return[
            'name.required'=>'El campo nombre es requerido',

            'role.required'=>'Debe seleccionar un rol',

            'email.required'=>'El campo Correo Electronico es requerido',
            'email.email'=>'El dato ingresado no es un Correo Electronico',
            'email.unique'=>'El Correo Electronico ya esta registrado',

            'password.required'=>'El campo contraseña es requerido',
            'password.min'=>'La contraseña debe poseer como minimo 8 caracteres',
        ];
    }
}
