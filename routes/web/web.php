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
  //  Route::get('/alamacen/articulo', 'admin\AlmacenController@articulo');
    // Modulo de Ingreso
    Route::post('Buscar/Proveedor', 'Movimiento\IngresosController@buscarProveedor');
    Route::post('Buscar/Producto', 'Movimiento\IngresosController@BuscarProducto');
    Route::post('AddCarrito', 'Movimiento\IngresosController@AddCarrito');
    Route::get('detallecarrito/{id}', 'Movimiento\IngresosController@detallecarrito');
    Route::get('getcarr/{id}','Movimiento\IngresosController@getcarr');
    Route::post('getcarrxprove/{id}','Movimiento\IngresosController@getcarrxprove');
    Route::post('UpdateCantidad','Movimiento\IngresosController@UpdateCantidad');
    Route::post('UpdateCantCarr','Movimiento\IngresosController@UpdateCantCarr');
    Route::post('EliminarProducto','Movimiento\IngresosController@EliminarProducto');
    Route::post('getcantidadComprobante','Movimiento\IngresosController@tipocomprobante');
    //pagar compras
     Route::post('Pagar','Movimiento\IngresosController@Pagar');
    Route::resource('Compras/Ingresos','Movimiento\IngresosController');
    //modulo ventas
     Route::resource('Ventas','Movimiento\VentaController');

     //modelo administrativo



