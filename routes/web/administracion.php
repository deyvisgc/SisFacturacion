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
 //modulo usuario
     Auth::routes();
     Route::resource('Usuario','admin\UsuarioController');
     Route::resource('Permisos','admin\PermisosController');
     Route::post('delete','admin\PermisosController@deletepermisos');
     Route::post('edit/{id}','admin\UsuarioController@edit');
     Route::post('update','admin\UsuarioController@update');

     Route::get('/home', 'HomeController@index')->name('home');
  //   Route::get('/loginprueba', 'Auth\LoginController@login');
//modulo Inicio de Sesion
 // Categoria
    Route::get('admin/Categoria', 'admin\AlmacenController@categoria');
    Route::post('admin/alamacen/categoria/AddCategoria','admin\AlmacenController@AddCategoria')->name('AddCategoria');
    Route::get('admin/alamacen/categoria/listarCategoria','admin\AlmacenController@listarCategoria');
    Route::get('admin/alamacen/categoria/getCategoria','admin\AlmacenController@getCategoria')->name('getCategoria');
    Route::post('admin/alamacen/categoria/updateCategoria/{id}','admin\AlmacenController@updateCategoria');
    Route::get('admin/alamacen/categoria/estadoInactivo','admin\AlmacenController@estadoInactivo');
    Route::get('admin/alamacen/categoria/estadoActivo','admin\AlmacenController@estadoActivo');
    Route::get('admin/alamacen/categoria/eliminar','admin\AlmacenController@EliminarCategoria');

    // Producto
    Route::get('admin/Producto', 'admin\AlmacenController@producto');
    Route::post('admin/alamacen/producto/Addproducto','admin\AlmacenController@addproducto');
    Route::get('admin/alamacen/producto/listarproducto','admin\AlmacenController@listarproducto');
    Route::get('admin/alamacen/producto/getproducto','admin\AlmacenController@getproducto');
    Route::post('admin/alamacen/producto/updateproducto/{id}','admin\AlmacenController@updateproducto');
    Route::get('admin/alamacen/producto/estadoInactivoproducto','admin\AlmacenController@estadoInactivoproducto');
    Route::get('admin/alamacen/producto/estadoActivoproducto','admin\AlmacenController@estadoActivoproducto');
    Route::get('admin/alamacen/producto/eliminarproducto','admin\AlmacenController@Eliminarproducto');
    // Caja
    Route::get('admin/Caja', 'admin\AlmacenController@Caja');
    Route::post('admin/caja/AddCaja','admin\AlmacenController@addCaja');
    Route::get('admin/caja/listarCaja','admin\AlmacenController@listarCaja');
    Route::get('admin/caja/getCaja','admin\AlmacenController@getCaja');
    Route::post('admin/caja/updateCaja/{id}','admin\AlmacenController@updateCaja');
    Route::get('admin/caja/estadoInactivoCaja','admin\AlmacenController@estadoInactivoCaja');
    Route::get('admin/caja/estadoActivoCaja','admin\AlmacenController@estadoActivoCaja');
    Route::get('admin/caja/eliminarcaja','admin\AlmacenController@EliminarCaja');






