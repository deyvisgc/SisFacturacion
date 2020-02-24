<?php


namespace App\Http\Repositorios;
use App\Http\Interfaces\IngresoInterface;
use DB;
class IngresosRepository implements IngresoInterface
{

    public function addcarrito($data)
    {
        $idproduc=$data->idprodu;
        $idprovee=$data->idprovee;
        $canrtidad=$data->cantidad;
     return  DB::select("call addcarIngreso(?,?,?)",array($idproduc,$canrtidad,$idprovee));
    }
    public function getcarrito($id){
        return  DB::select("call GetCarritoIngresos(?)",array($id));
    }

    public function UpdateCantidad($data)
    {
        $Cantidad=$data->cantidad;
       $idcarrito=$data->idtem;
       $IdProve=$data->idprove;
        return  DB::select("call UpdateCantidad(?,?,?)",array($Cantidad,$idcarrito,$IdProve));
    }
}
