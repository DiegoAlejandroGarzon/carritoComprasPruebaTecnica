<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class products extends Model
{
    protected $fillable = [
        'nombre',
        'precio',
        'descripcion',
        'path'
    ];
}
