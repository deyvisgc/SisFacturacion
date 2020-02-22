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
     return  DB::select("call addcarritoProvee(?,?,?)",array($idproduc,$canrtidad,$idprovee));
    }
    public function getcarrito($id){
        return  DB::select("call Pruebaaddcarrito(?)",array($id));
    }

}
