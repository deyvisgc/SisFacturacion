<?php

namespace App\Http\Controllers\admin;

use App\Http\Repositorios\AlmacenRepository;
use App\Modelos\Caja;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Yajra\DataTables\DataTables;
use DB;

class AlmacenController extends Controller
{

    /**
     * AlmacenController constructor.
     * @param AlmacenRepository $repository
     */
    public function __construct(AlmacenRepository $repository)
    {
        $this->repository = $repository;
    }

    public function producto(){
        $categoriaActivo=AlmacenRepository::listCategoriaActivo();
        return view('admin.almacen.producto.index',compact('categoriaActivo'));
    }
    public function addproducto(Request $request){
        AlmacenRepository::insertarproducto($request);
        return response()->json(array("success" => true));
    }
    public function listarproducto(){
        $list = AlmacenRepository::listproducto();
        return DataTables::of($list)->addColumn('imagen', function ($pro){
            $url= asset('Imagenes/Productos/'.$pro->ruta_imagen);
            return '<img src="'.$url.'"  height="60px" width="60px"/>';
        })->rawColumns(['imagen'])->make(true);
    }
    public function getproducto(Request $request){
        $update = AlmacenRepository::getproducto($request->id);
        return response()->json([$update]);
    }
    public function updateproducto(Request $request,$id){
        AlmacenRepository::updateCategoria($request,$id);
        return response()->json(array("success" => true));
    }
    public function Eliminarproducto(Request $request){
        $del=AlmacenRepository::EliminarCategoria($request['id']);
        return $del;
    }
    public function estadoInactivoproducto(Request $request){
        $dato=AlmacenRepository::estadoInactivo($request['id']);
        return $dato;
    }
    public function estadoActivoproducto(Request $request){
        $dato=AlmacenRepository::estadoActivo($request['id']);
        return $dato;
    }
    /************* CATEGORIA  *************************************/
    public function categoria(){
        return view('admin.almacen.categoria.index');
    }
    public function addCategoria(Request $request){
         AlmacenRepository::insertar($request);
        return response()->json(array("success" => true));
    }
    public function listarCategoria(){
        $list = AlmacenRepository::listCliente();
        return DataTables::of($list)->make(true);
    }
    public function getCategoria(Request $request){
        $update = AlmacenRepository::getCategoria($request->id);
        return response()->json([$update]);
    }
    public function updateCategoria(Request $request,$id){
        AlmacenRepository::updateCategoria($request,$id);
        return response()->json(array("success" => true));
    }
    public function EliminarCategoria(Request $request){
    $del=AlmacenRepository::EliminarCategoria($request['id']);
    return $del;
    }
    public function estadoInactivo(Request $request){
        $dato=AlmacenRepository::estadoInactivo($request['id']);
        return $dato;
    }
    public function estadoActivo(Request $request){
        $dato=AlmacenRepository::estadoActivo($request['id']);
        return $dato;
    }
    /************* CAJA  *************************************/
    public function Caja(){
        $user=AlmacenRepository::estadoUsuario(1);
        return view('admin.caja.index',compact('user'));
    }
    public function addCaja(Request $request){
        AlmacenRepository::insertarCaja($request);
        return response()->json(array("success" => true));
    }
    public function listarCaja(){
        $list = AlmacenRepository::listCaja();
        return DataTables::of($list)->make(true);
    }
    public function getCaja(Request $request){
        $update = AlmacenRepository::getCaja($request->id);
        return response()->json([$update]);
    }
    public function updateCaja(Request $request,$id){
        AlmacenRepository::updateCaja($request,$id);
        return response()->json(array("success" => true));
    }
    public function EliminarCaja(Request $request){
        $del=AlmacenRepository::EliminarCaja($request['id']);
        return $del;
    }
    public function estadoInactivoCaja(Request $request){
        $dato=AlmacenRepository::estadoInactivoCaja($request['id']);
        return $dato;
    }
    public function estadoActivoCaja(Request $request){
        $dato=AlmacenRepository::estadoActivoCaja($request['id']);
        return $dato;
    }
    /************* APERTURA DE CAJA  *************************************/
    public function aperturacaja(){
        $id_user = Auth::user()->idusuarios;
       $caja=DB::table('caja as c')
           ->join('usuarios as u','c.usuarios_idusuarios','=','u.idusuarios')
           ->where('c.usuarios_idusuarios','=',$id_user)
           ->select('c.idCaja','c.caj_descripcion')->get();
       $caja1=DB::table('caja')->where('idusuarios','=',$id_user);
        return view('admin.caja.aperturacaja',['caja'=>$caja,'caja1'=>$caja1]);

    }
    public function store(Request $request){
        return response()->json($this->repository->aperturarcaja($request));
    }
    public function gettotalcaja(Request $request){
        $id_user = Auth::user()->idusuarios;
        return response()->json($this->repository->obtenertotalcaja($id_user,$request));
    }
    public function cerrarcaja(Request $request){
        return response()->json($this->repository->cerrarcaja($request));
    }
}
