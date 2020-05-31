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
    Route::post('buscar/Proveedor', 'Movimiento\IngresosController@buscarProveedor');
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
     Route::post('ModuloVentas/validarcaja','Movimiento\VentaController@validarcajaaperurada');
     Route::post('ModuloVentas/ADDCARRITO','Movimiento\VentaController@ADDCARRITO');
Route::post('ModuloVentas/Listarcarrito','Movimiento\VentaController@Listarcarrito');
Route::post('ModuloVentas/Obtenertotales','Movimiento\VentaController@Obtenertotales');
Route::post('ModuloVentas/UpdateCantidadd','Movimiento\VentaController@UpdateCantidadd');
Route::post('ModuloVentas/EliminarCarrito','Movimiento\VentaController@EliminarCarrito');
Route::post('ModuloVentas/Obtenercantidadcomprobante','Movimiento\VentaController@Obtenercantidadcomprobante');
Route::post('ModuloVentas/Vender','Movimiento\VentaController@Vender');
//clientes nuevos del sistema
Route::post('ModuloVentas/validardni','Movimiento\VentaController@validardni');
Route::post('ModuloVentas/crearnewcliente','Movimiento\VentaController@crearnewcliente');
Route::post('ModuloVentas/validarruc','Movimiento\VentaController@validarruc');
Route::post('ModuloVentas/crearnewclientexruc','Movimiento\VentaController@crearnewclientexruc');
Route::get('ModuloVentas/descargarcomprobante','Movimiento\VentaController@descargarcomprobante');


//busquedas del sistema
Route::post('buscar/buscardni','Movimiento\VentaController@buscardni');
Route::post('buscar/buscarruc','Movimiento\VentaController@buscarruc');
Route::post('buscar/buscardnixsistema','Movimiento\VentaController@buscardnixsistema');
Route::post('buscar/Productoventa', 'Movimiento\VentaController@BuscarProducto');


     //modelo administrativo



