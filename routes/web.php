<?php

use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', 'HomeController@index')->name('home');

Auth::routes();

Route::get('/home', 'HomeController@index');
Route::get('/shoppingCar', 'shoppingController@index')->name('shoppingCar');
Route::post('/addShoppingCar/{idProduct}', 'shoppingController@addProductShoppingCar');
Route::post('/deleteProductShoppingCar/{idShoppingCar}', 'shoppingController@deleteProductShoppingCar');
Route::post('/saveShopping', 'shoppingController@saveShopping');

Route::group(['middleware' => ['role:Administrator']], function () {
    Route::post('/createUser', 'userController@create');
    Route::post('/updateUser', 'userController@update');
    Route::get('/usersList', 'userController@usersList');
    Route::post('/deleteUser/{id}', 'userController@delete');
});

