<?php

namespace App\Http\Controllers\admin;

use App\Modelos\Rol;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Yajra\DataTables\DataTables;

class PermisosController extends Controller
{
    public function index(Request $request){
         $rol=Rol::all();
        if ($request->ajax()){
            return Datatables::of($rol)->make(true);
        }
        return view('admin.Administracion.Permisos.rolPrivilegios');
    }
    public function store(Request $request){
        $rol=new Rol();
        $rol->nombre_rol=$request->rol;
        $rol->estado_rol=1;
        $rol->save();
        if ($rol==true){
            return response()->json('exito al guardar');
        }else{
            return response()->json('error');
        }
    }
    public function deletepermisos(Request $request){
        $idrol=$request->idrol;
        $rol=Rol::find($idrol);
        if ($rol){
          return response()->json($rol->delete());
        }else{
            return response()->json('error');
        }
    }
}
