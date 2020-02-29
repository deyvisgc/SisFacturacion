<?php


namespace App\Http\Repositorios;
use App\Http\Interfaces\IngresoInterface;
use App\TipoComprobante;
use DB;
class IngresosRepository implements IngresoInterface
{

    public function addcarrito($data)
    {
        $idproduc=$data->idprodu;
        $iduser=$data->iduser;
        $canrtidad=$data->cantidad;
        $precio=$data->precio_compra;
        $idprove=$data->idprove;
     return  DB::select("call addcarIngreso(?,?,?,?,?)",array($idproduc,$canrtidad,$iduser,$precio,$idprove));
    }
    public function getcarrito($id){
        return  DB::select("call GetCarrito(?)",array($id));
    }

    public function UpdateCantidad($data)
    {
        $Cantidad=$data->cantidad;
       $idcarrito=$data->idtem;
       $idvendedor=$data->idvendedor;
        return  DB::select("call UpdateCantidad(?,?,?)",array($Cantidad,$idcarrito,$idvendedor));
    }

    Public function ElimianrCarrito($data)
    {

        if ($data->id==''){
            return 'registro no encontrado';
        }else{
           $id= $data->id;
           $iduser=$data->iduser;
           DB::table('temcarrito')->where('id_Tem_Carito','=',$id)->where('usuario_id_usuario','=',$iduser)->delete();
            return  DB::select("call GetCarrito(?)",array($iduser));

        }
    }

    public function Pagar($data)
    {
        $idusuario=$data->idusuario;
        $monto_efectivo=$data->monto_efectivo;
        $monto_credito=0;
        $monto_debito=0;
        $vuelto=$data->vuelto;
        $tipo_pago=$data->tipo_pago;
        $tipo_comprovante=$data->comprobante;
        return DB::select("call proc_ingreso_registrar(?,?,?,?,?,?,?)",array($idusuario,$monto_efectivo,$monto_credito,$monto_debito,$vuelto,$tipo_pago,$tipo_comprovante));

    }
    public function getcantidadcomprobante($data){
      $idcom =$data->idcompro;
      if ($idcom !=''){
          return TipoComprobante::where('id','=',$idcom)->select('cantidad','serie','id')->get();
      }else{
          return 'no existe id comprobante';
      }
    }

}
