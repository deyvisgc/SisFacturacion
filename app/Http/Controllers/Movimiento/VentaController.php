<?php

namespace App\Http\Controllers\Movimiento;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class VentaController extends Controller
{
 public function index(){
     return view('admin.Ventas.ventas');
 }
 public function store(){
     return response()->json('sdsdsds');
 }
}
