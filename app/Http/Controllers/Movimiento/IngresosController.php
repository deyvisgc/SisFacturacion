<?php

namespace App\Http\Controllers\Movimiento;

use App\Http\Controllers\Controller;
use App\Http\Repositorios\IngresosRepository;
use App\Modelos\TipoComprobante;
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
      $tipocomprobante=TipoComprobante::all();
      return view('admin.Compras.Ingresos',compact('tipocomprobante'));
  }
  public function tipocomprobante(Request $request){
    return response()->json($this->repository->getcantidadcomprobante($request));
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
        $query=DB::select(" SELECT  p.Nombre_Productos,p.Precio_Productos,p.idProductos,p.precio_compra, p.precio_venta FROM productos as p WHERE  p.Nombre_Productos LIKE  '%".$producto."%'");
        foreach ($query as $quer)
        {
            $resulta[] = [ 'idproducto' => $quer->idProductos, 'value' =>$quer->Nombre_Productos, 'precio' =>$quer->Precio_Productos,'precio_compra'=>$quer->precio_compra,'precio_venta'=>$quer->precio_venta];
        }
        $data=array('hecho'=>'si','list_cliente'=>$resulta);

        if ($data===false){
            return response()->json('errors.custom', [], 500);
        }else{
            echo json_encode($data);
        }


    }
    public function AddCarrito(Request $request){
        $resultado=$this->repository->addcarrito($request);
        $subotal=$resultado[0]->subtotal;
        $IGV=$subotal*0.18;
        $total=$subotal+$IGV;
        $count=$resultado[0]->count;
        return response()->json(array('Igv'=>$IGV,'subtotal'=>$subotal,'total'=>$total,'count'=>$count));
    }
    public function detallecarrito($id){
        $result=$this->repository->getcarrito($id);
        return DataTables::of($result)->make(true);
    }
    public function getcarr(Request $request,$id){
        $result=$this->repository->getcarrito($id);
        if ($request->ajax()){
            return DataTables::of($result)->make(true);
        }
    }
    public function getcarrxprove($id){
        $resultado=$this->repository->getcarrito($id);
        $subotal=$resultado[0]->sumsubtotal;
        $IGV= round($subotal*0.18, 4);
        $total= round($subotal+$IGV, 4);
     //   $count=$resultado[0]->count;
        return response()->json(array('Igv'=>$IGV,'subtotal'=>$subotal,'total'=>$total));
    }
    public function UpdateCantidad(Request $request){
        return response()->json($this->repository->UpdateCantidad($request));
    }
    public function EliminarProducto(Request $request){
        $resultado=$this->repository->ElimianrCarrito($request);
        if (isset($resultado)==null){
            return 'sin registros';
        }else{
            $subotal=$resultado[0]->sumsubtotal;
            $IGV= round($subotal*0.18, 4);
            $total= round($subotal+$IGV, 4);
            //   $count=$resultado[0]->count;
            return response()->json(array('Igv'=>$IGV,'subtotal'=>$subotal,'total'=>$total));
        }

    }
    public function UpdateCantCarr(Request $request){
        $Cantidad=$request->cantidad;
        $idcarrito=$request->idtem;
        $Iduser=$request->idvendedor;
        return  DB::select("call UpdateCantidad(?,?,?)",array($Cantidad,$idcarrito,$Iduser));
    }
    public function Pagar(Request $request){
        $this->repository->Pagar($request);
        $detalle=DB::select("SELECT productos.Nombre_Productos,productos.precio_compra,empresas.Razon_social_Empre,empresas.Ruc_Empre,ingresos.Ingre_IGV,ingresos.Ingre_Fecha, ingresos.Ingre_Subtotal,detalle_ingreso.Ingre_Deta_Total,detalle_ingreso.Ingre_Deta_Cantidad from detalle_ingreso,ingresos,productos,empresas WHERE detalle_ingreso.Ingresos_Id_Ingresos=ingresos.Id_Ingresos and detalle_ingreso.productos_idProductos=productos.idProductos and detalle_ingreso.id_proveedor=empresas.Id_Empresas_Empre and ingresos.Usuario_id_Usuarios=1");
        return response()->json($detalle);
    }



}
