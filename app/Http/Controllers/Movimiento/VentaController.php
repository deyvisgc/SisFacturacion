<?php

namespace App\Http\Controllers\Movimiento;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Tecactus\Reniec\DNI;
class VentaController extends Controller
{
 public function index(){
     return view('admin.Ventas.ventas');
 }
 public function store(){
     return response()->json('sdsdsds');
 }
 public function buscardni(Request $request){
     $essalud = new \jossmp\essalud\asegurado();
     $dni = $request->dni;
     $search2 = $essalud->consulta( $dni );
     if($search2->success == true )
     {
         return response()->json($search2->result);
     }
 }
}
