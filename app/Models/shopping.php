<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class shopping extends Model
{
    protected $fillable = [
        'id_user',
        'id_products',
        'N_compra',
        'dateShopping'
    ];
}
