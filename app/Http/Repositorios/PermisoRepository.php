<?php


namespace App\Http\Repositorios;


use App\Http\Interfaces\PermisosInterface;
use App\Modelos\Privilegios;
use App\Modelos\RolPrivilegios;
use Illuminate\Queue\Console\RetryCommand;
use Illuminate\Support\Facades\DB;

class PermisoRepository implements  PermisosInterface
{

    public function registrarprivilegio($request)
    {
      $value= $request->idpadre;
        $array = explode("and", $value);
        $idpadre=$array[0];
        $nombgrupo=$array[1];

        DB::beginTransaction();
        try {
            $privi=new Privilegios();
            $privi->nombre_Privi=$request->nombre_privi;
            $privi->ruta_Privi=$request->ruta_privi;
            $privi->grupo_Privi=$nombgrupo;
            $privi->icon_privi=$request->icon_privi;
            $privi->estado_Privi=1;
            $privi->id_privi_Padre=$idpadre;
            $privi->save();
            DB::commit();
        }catch (\Exception $e){
            DB::rollback();
            return array('el error es'=>$e);

        }
        $data=['succes'=>true];
        return $data;
    }
    public function RegistrarPermisos(array $data,$idrol,$idpadre){
        for ($i=0; $i <= intval($data["zise"]) - 1; $i++) {
            RolPrivilegios::create([
                'id_rol'=>$idrol,
                'id_Privilegio'=> $data["id"][$i]['id'],
                 'id_Privilegio_padre'=>$idpadre,
                  'rol_has_estado'=>1
              //  'id_accesorio'=>$idacc['id'][$i]['id']
            ]);
        }
        $data['succes']=true;
        return $data;
    }
    public function editarPrivilegio($data)
    {
        // TODO: Implement editarPrivilegio() method.
    }

    public function Eliminarprivilegio($data)
    {
        // TODO: Implement Eliminarprivilegio() method.
    }

    public function getPermisos()
    {
            return DB::table('rol_privilegios as rp')
            ->join('rol as r','rp.id_rol','=','r.id_rol')
            ->join('privilegios as p','rp.id_Privilegio','=','p.id_Privilegios')
            ->select('p.nombre_Privi','p.grupo_Privi','p.id_privi_Padre','r.nombre_rol','rp.rol_has_estado')
            ->orderBy('rp.Id_RolPrivilegios')->get();
    }
    public function getPrivilegiohijos($id){
       return Privilegios::where([['id_privi_Padre','<>',null], ['id_privi_Padre','=',$id]])->get();


    }
}
