<?php

namespace App\Http\Controllers;

use App\Http\Repositorios\IngresosRepository;
use Illuminate\Http\Request;
use DB;
use Yajra\DataTables\DataTables;

class IngresosController extends Controller
{
    /**
     * @var IngresosRepository
     */
    private $repository;

    /**
     * IngresosController constructor.
     * @param IngresosRepository $repository
     */
    public function __construct(IngresosRepository $repository)
    {
        $this->repository = $repository;
    }

    public function index(){
      return view('admin.Compras.Ingresos');
  }
  public function buscarProveedor(Request $request){
      $provee=$request->texto;
      $query=DB::select(" SELECT  empresas.Id_Empresas_Empre,empresas.Razon_social_Empre,empresas.Ruc_Empre FROM empresas,tipo_persona WHERE tipo_persona.id_Empresas=empresas.Id_Empresas_Empre and empresas.Ruc_Empre LIKE  '%".$provee."%'");
      foreach ($query as $quer)
      {
          $resulta[] = [ 'idprovee' => $quer->Id_Empresas_Empre, 'value' =>$quer->Razon_social_Empre.' '.$quer->Ruc_Empre,'razonsocial' =>$quer->Razon_social_Empre,'ruc' =>$quer->Ruc_Empre];
      }
      $data=array('hecho'=>'si','list_cliente'=>$resulta);
      if ($data===false){
          return response()->json('errors.custom', [], 500);
      }else{
          echo json_encode($data);
      }


  }
    public function BuscarProducto(Request $request){
        $producto=$request->texto;
        $query=DB::select(" SELECT  p.Nombre_Productos,p.Precio_Productos,p.idProductos FROM productos as p WHERE  p.Nombre_Productos LIKE  '%".$producto."%'");
        foreach ($query as $quer)
        {
            $resulta[] = [ 'idproducto' => $quer->idProductos, 'value' =>$quer->Nombre_Productos, 'precio' =>$quer->Precio_Productos];
        }
        $data=array('hecho'=>'si','list_cliente'=>$resulta);
        if ($data===false){
            return response()->json('errors.custom', [], 500);
        }else{
            echo json_encode($data);
        }


    }
    public function AddCarrito(Request $request){
       return response()->json($this->repository->addcarrito($request));

    }
    public function getcarrito($id){
        $result=$this->repository->getcarrito($id);
        return DataTables::of($result)->make(true);
    }
    public function getcarr(){
        $result=DB::table('temcarrito as tem')->join('productos as p','tem.id_Producto','=','p.idProductos')->select('*','p.Nombre_Productos','p.Precio_Productos')->get();
        return DataTables::of($result)->make(true);
    }

}
