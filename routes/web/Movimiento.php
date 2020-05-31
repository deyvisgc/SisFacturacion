<?php

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

Route::get('/', function () {
    return view('auth.login');
});

   // Route::get('/', 'admin\HomeController@index');
// Route::get('/', 'admin\HomeController@index');
  //  Route::get('/alamacen/articulo', 'admin\AlmacenController@articulo');
    // Modulo de Ingreso
######apertura de caja#######################33
Route::resource('Aperturacaja','admin\AlmacenController');
Route::get('Movimiento/Aperturacaja','admin\AlmacenController@aperturacaja');
Route::post('Movimiento/gettotalcaja','admin\AlmacenController@gettotalcaja');
Route::post('Movimiento/cerrarcaja','admin\AlmacenController@cerrarcaja');
Route::post('Movimiento/buscar','admin\AlmacenController@buscar');
Route::get('Movimiento/verfactura','admin\AlmacenController@vefactura');


//modelo administrativo



