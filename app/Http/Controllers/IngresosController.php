<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class IngresosController extends Controller
{
  public function index(){
      return view('admin.Compras.Ingresos');
  }
}
