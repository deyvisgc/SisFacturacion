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
     Route::post('edit/{id}','admin\UsuarioController@edit');
     Route::post('update','admin\UsuarioController@update');

     Route::get('/home', 'HomeController@index')->name('home');
  //   Route::get('/loginprueba', 'Auth\LoginController@login');
//modulo Inicio de Sesion





