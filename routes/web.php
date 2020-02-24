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
    /****** CATEGORIA *****************/
    Route::get('admin/alamacen/producto', 'admin\AlmacenController@producto');
    Route::post('admin/alamacen/producto/Addproducto','admin\AlmacenController@Addproducto');
    Route::get('admin/alamacen/producto/listarproducto','admin\AlmacenController@listarproducto');
    Route::get('admin/alamacen/producto/getproducto','admin\AlmacenController@getproducto');
    Route::post('admin/alamacen/producto/updateproducto/{id}','admin\AlmacenController@updateproducto');
    Route::get('admin/alamacen/producto/eliminarproducto','admin\AlmacenController@Eliminarproducto');
    Route::get('admin/alamacen/producto/estadoInactivoproducto','admin\AlmacenController@estadoInactivoproducto');
    Route::get('admin/alamacen/producto/estadoActivoproducto','admin\AlmacenController@estadoActivoproducto');
    /**********************************/
    /****** CATEGORIA ****************/
    Route::get('admin/alamacen/categoria', 'admin\AlmacenController@categoria');
    Route::post('admin/alamacen/categoria/AddCategoria','admin\AlmacenController@AddCategoria');
    Route::get('admin/alamacen/categoria/listarCategoria','admin\AlmacenController@listarCategoria');
    Route::get('admin/alamacen/categoria/getCategoria','admin\AlmacenController@getCategoria');
    Route::post('admin/alamacen/categoria/updateCategoria/{id}','admin\AlmacenController@updateCategoria');
    Route::get('admin/alamacen/categoria/eliminar','admin\AlmacenController@EliminarCategoria');
    Route::get('admin/alamacen/categoria/estadoInactivo','admin\AlmacenController@estadoInactivo');
    Route::get('admin/alamacen/categoria/estadoActivo','admin\AlmacenController@estadoActivo');
    /***********************************/
    Route::resource('Compras/Ingresos','IngresosController');
