<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use App\Http\Repositorios\UsuarioRepository;
use App\Modelos\Rol;
use App\Modelos\Usuario;
use Illuminate\Http\Request;
use Yajra\DataTables\DataTables;

class UsuarioController extends Controller
{
    /**
     * UsuarioController constructor.
     * @param UsuarioRepository $repository
     */


    public function __construct(UsuarioRepository $repository)
    {
        $this->repository = $repository;
        $this->middleware('guest');
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */

    public function index(Request  $request)
    {
      $rol=Rol::where('estado_rol','=',1)->get();
        $result=$this->repository->listar();
        if ($request->ajax()){
            return Datatables::of($result)
                ->addColumn('imagen', function ($pro){
                    $url= asset('Imagenes/Usuarios/'.$pro->user_foto);
                    return '<img src="'.$url.'"  height="60px" width="60px"/>';
                })->rawColumns(['imagen'])->make(true);
        }
       return view('admin.Administracion.usuario',compact('rol'));
    }
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        return  response()->json($this->repository->Store($request));
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Usuario  $usuario
     * @return \Illuminate\Http\Response
     */
    public function show(Usuario $usuario)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Usuario  $usuario
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
      return response()->json($this->repository->edit($id));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Usuario  $usuario
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request)
    {
        return response()->json($this->repository->Actualizar($request));
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Usuario  $usuario
     * @return \Illuminate\Http\Response
     */
    public function destroy(Usuario $usuario)
    {
        //
    }
}
