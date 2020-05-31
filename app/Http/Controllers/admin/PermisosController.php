<?php

namespace App\Http\Controllers\admin;

use App\Http\Repositorios\PermisoRepository;
use App\Modelos\Rol;
use App\Modelos\Privilegios;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Yajra\DataTables\DataTables;

class PermisosController extends Controller
{
    /**
     * @var PermisoRepository
     */
    private $repository;

    /**
     * PermisosController constructor.
     * @param PermisoRepository $repository
     */
    public function __construct(PermisoRepository $repository)
    {
        $this->repository=$repository;
    }

    public function index(Request $request){
        $permisos=$this->repository->getPermisos();
        if ($request->ajax()){
            return Datatables::of($permisos)->make(true);
        }
        return view('admin.Administracion.Permisos.AsignarPersmisos');

    }
    public function getAsignarPermisos(Request $request){
        $rol=Rol::all();
        $privipadre = Privilegios::where('id_privi_Padre','=',null)->get();
        return view('admin.Administracion.Permisos.AsignarPersmisos',array('rol'=>$rol,'privipadre'=>$privipadre));
    }
    public function getprivihijos(Request $request){
        return response()->json($this->repository->getPrivilegiohijos($request->idprivihijos));
    }
    public function regispermisos(Request $request){
        return response()->json($this->repository->RegistrarPermisos($request->data[0],$request->idrol,$request->idpadre));
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
