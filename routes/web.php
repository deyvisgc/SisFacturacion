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

/*Route::get('/', function () {
    return view('welcome');
});*/
    Route::get('/', 'admin\HomeController@index');
    Route::get('/alamacen/articulo', 'admin\AlmacenController@articulo');
    Route::post('Buscar/Proveedor', 'IngresosController@buscarProveedor');
    Route::post('Buscar/Producto', 'IngresosController@BuscarProducto');
    Route::post('AddCarrito', 'IngresosController@AddCarrito');
    Route::get('getcarrito/{id}', 'IngresosController@getcarrito');
    Route::get('getcarr/{id}','IngresosController@getcarr');
    Route::post('getcarrxprove/{id}','IngresosController@getcarrxprove');
    Route::post('UpdateCantidad','IngresosController@UpdateCantidad');
    Route::resource('Compras/Ingresos','IngresosController');
