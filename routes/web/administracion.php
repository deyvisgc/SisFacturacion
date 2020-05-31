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


     Route::post('Permisos/getprivihijos','admin\PermisosController@getprivihijos');
     Route::post('Permisos/regispermisos','admin\PermisosController@regispermisos');
     Route::resource('Permisos','admin\PermisosController');
     //para asignar nuevas rutas a un resource el resource debe estar abajo de las nuevas rutas para que pueda dar
     Route::get('PriviRol/getrol','admin\PrivilegioRolComtroller@getrol');
     Route::resource('PriviRol','admin\PrivilegioRolComtroller');

     Route::get('AsignarPermisos','admin\PermisosController@getAsignarPermisos');
     Route::post('delete','admin\PermisosController@deletepermisos');
     Route::post('edit/{id}','admin\UsuarioController@edit');
     Route::post('update','admin\UsuarioController@update');

     Route::get('/home', 'HomeController@index')->name('home');
  //   Route::get('/loginprueba', 'Auth\LoginController@login');
//modulo Inicio de Sesion
 // Categoria
    Route::get('admin/Categoria', 'admin\AlmacenController@categoria');
    Route::post('admin/almacen/categoria/AddCategoria','admin\AlmacenController@AddCategoria')->name('AddCategoria');
    Route::get('admin/almacen/categoria/listarCategoria','admin\AlmacenController@listarCategoria');
    Route::get('admin/almacen/categoria/getCategoria','admin\AlmacenController@getCategoria')->name('getCategoria');
    Route::post('admin/almacen/categoria/updateCategoria/{id}','admin\AlmacenController@updateCategoria');
    Route::get('admin/almacen/categoria/estadoInactivo','admin\AlmacenController@estadoInactivo');
    Route::get('admin/almacen/categoria/estadoActivo','admin\AlmacenController@estadoActivo');
    Route::get('admin/almacen/categoria/eliminar','admin\AlmacenController@EliminarCategoria');

    // Producto
    Route::get('admin/Producto', 'admin\AlmacenController@producto');
    Route::post('admin/almacen/producto/Addproducto','admin\AlmacenController@addproducto');
    Route::get('admin/almacen/producto/listarproducto','admin\AlmacenController@listarproducto');
    Route::post('admin/almacen/producto/getproducto','admin\AlmacenController@getproducto');
    Route::post('admin/almacen/producto/updateproducto/{id}','admin\AlmacenController@updateproducto');
    Route::post('admin/almacen/producto/activarProducto','admin\AlmacenController@activarproducto');
    Route::post('admin/almacen/producto/desactivarProducto','admin\AlmacenController@Desactivar');
    Route::post('admin/almacen/producto/eliminarproducto','admin\AlmacenController@Eliminarproducto');
    // Caja
    Route::get('admin/Caja', 'admin\AlmacenController@Caja');
    Route::post('admin/caja/AddCaja','admin\AlmacenController@addCaja');
    Route::get('admin/caja/listarCaja','admin\AlmacenController@listarCaja');
    Route::get('admin/caja/getCaja','admin\AlmacenController@getCaja');
    Route::post('admin/caja/updateCaja/{id}','admin\AlmacenController@updateCaja');
    Route::get('admin/caja/estadoInactivoCaja','admin\AlmacenController@estadoInactivoCaja');
    Route::get('admin/caja/estadoActivoCaja','admin\AlmacenController@estadoActivoCaja');
    Route::get('admin/caja/eliminarcaja','admin\AlmacenController@EliminarCaja');






