<?php

namespace App\Http\Controllers\admin;
use App\Http\Controllers\Controller;
use App\Http\Repositorios\PermisoRepository;
use App\Modelos\Privilegios;
use App\Modelos\Rol;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use mysql_xdevapi\Exception;
use Yajra\DataTables\DataTables;

class PrivilegioRolComtroller extends Controller
{
    /**
     * PrivilegioRolComtroller constructor.
     * @param PermisoRepository $repository
     */
    public function __construct(PermisoRepository $repository)
    {
        $this->permisorepositorio=$repository;
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */

    public function index(Request $request)
    {
        $privi=DB::table('privilegios')->orderBy('id_Privilegios', 'asc')->get();

        $PriviPadre=Privilegios::where('id_privi_Padre','=',null)->get();
        if ($request->ajax()){
           return $data1= Datatables::of($privi)->make(true);
        }
        return view('admin.Administracion.Permisos.rolPrivilegios',array('privipadre'=>$PriviPadre));
    }
    public function getrol(){
        $rol=Rol::all();
        return Datatables::of($rol)->make(true);
       // return view('admin.Administracion.Permisos.rolPrivilegios');
    }

    public function create()
    {
        //
    }
    public function store(Request $request)
    {

       $privi= $this->permisorepositorio->registrarprivilegio($request);
        if ($privi){
            return response()->json($privi);
        }else{
            return response()->json('error');
        }
    }
    public function show($id)
    {
        //
    }
    public function edit($id)
    {
        //
    }

    public function update(Request $request, $id)
    {
        //
    }

    public function destroy($id)
    {
        //
    }
}
