<?php

use App\Models\products;
use Illuminate\Database\Seeder;

class productsSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        products::create([
            'name' => 'Barquillo Relleno',
            'precio' => '1390',
            'path' => '/img/barquilloRelleno.png',
            ]);
        products::create([
            'name' => 'Cerezas Marraschino',
            'precio' => '3990',
            'path' => '/img/cerezasMarraschino.png',
            ]);
        products::create([
            'name' => 'Detergente Multiusos',
            'precio' => '3790',
            'path' => '/img/detergenteMultiusos.png',
            ]);
        products::create([
            'name' => 'Galleta Oreo 216g',
            'precio' => '3750',
            'path' => '/img/galletaOreo6PQ216g.png',
            ]);
        products::create([
            'name' => 'Salsa Crema Ahumada',
            'precio' => '2490',
            'path' => '/img/salsaCremaAhumada.png',
            ]);
        products::create([
            'name' => 'Salsa Maíz Dulce',
            'precio' => '2390',
            'path' => '/img/salsaMaizDulce.png',
            ]);
        products::create([
            'name' => 'Uva verde 500g',
            'precio' => '9190',
            'path' => '/img/uvaVerde500g.png',
            ]);
        products::create([
            'name' => 'Vaso Desechable 7oz',
            'precio' => '9190',
            'path' => '/img/vasoDesechable7oz.png',
            ]);
    }
}
