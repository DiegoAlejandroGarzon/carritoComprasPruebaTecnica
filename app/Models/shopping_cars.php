<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class shopping_cars extends Model
{
    protected $fillable = [
        'id_user',
        'id_products'
    ];
    
    public function product()
    {
        return $this->belongsTo('App\Models\products', 'id_products', 'id');
    }
}
