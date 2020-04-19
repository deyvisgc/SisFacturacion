<?php


namespace App\Http\Repositorios;
use App\Modelos\Empresa;
use App\Modelos\Persona;
use App\Modelos\TipoComprobante;
use App\Modelos\TipoPersona;
use DB;

use App\Http\Interfaces\VentaInterface;

class VentaRepository implements VentaInterface
{

    public function buscardni($data)
    {
        // TODO: Implement buscardni() method.
    }

    public function buscarruc($ruc)
    {
        $endpoint = "https://api.migoperu.pe/api/v1/ruc";
        $token = "75a37a22-7ed5-4d0e-9361-d52802963a0e-f1083ca8-34e2-42ab-a742-b408c9e956a1";
        $data = array(
            "token"	=> $token,
            "ruc"   =>$ruc
        );
        $ch = curl_init($endpoint);
        curl_setopt(
            $ch,
            CURLOPT_HTTPHEADER,
            array(
                'Content-Type: application/json',
            )
        );
        curl_setopt($ch, CURLOPT_POST, 1);
        curl_setopt($ch, CURLOPT_POSTFIELDS, json_encode($data));
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        $json = curl_exec($ch);
        curl_close($ch);
        return json_decode($json, true);
    }

    public function buscardnicxsistema($data)
    {
        $query = DB::table('persona')->where('dni_per', 'like',  '%' . $data . '%')->get();
        foreach ($query as $quer)
        {
            $resulta[] = [ 'idpersona' => $quer->id_Persona, 'value' =>$quer->nombre_per.' '.$quer->apellidos_per,'dni' =>$quer->dni_per];
        }
        $data=array('hecho'=>'si','list_cliente'=>$resulta);
        if ($data===false){
            return response()->json('errors.custom', [], 500);
        }else{
            echo json_encode($data);
        }
    }

    public function validarcajaabierta($idprove)
    {
        if ( $hola=DB::table('caja as c')
            ->join('detallecaja as dtc','dtc.id_Caja','=','c.idCaja')
            ->select('dtc.Caja_abierta')
            ->where('dtc.Caja_abierta','=',1)
            ->where('c.usuarios_idusuarios','=',$idprove)->exists()) {
          return $hola;
        }else{
            return 'caja cerrada' ;
        }

    }
    public function addcarrito($data){

       $varidproducto=$data->idproducto;
        $cantidad=$data->cantidad;
        $idvendedor=$data->idvendedor;
        $precio=$data->precio;
        $caja=$data->idcaja;
        $idpersona=$data->idpersona;
        $ganancias=$data->ganancias;
        $idproveedor=$data->idproveedor;
        return  DB::select("call addcarVenta(?,?,?,?,?,?,?,?)",array($varidproducto,$cantidad,$idvendedor,$precio,$caja,$idpersona,$ganancias,$idproveedor));
    }
    public function Listcarrito($idvendedor,$idcliente,$idproveedor){
        if ($idcliente==null || $idcliente=='undefined'){
            return $query=DB::table('temcarrito as tem')
                ->join('empresas as empre','tem.id_Proveedor','=','empre.Id_Empresas_Empre')
                ->join('productos as pr','tem.id_Producto','=','pr.idProductos')
                ->where('tem.id_Proveedor','=',$idproveedor)
                ->where('tem.usuario_id_usuario','=',$idvendedor)
                ->select('empre.Razon_social_Empre as nombres','tem.Precio_Venta','tem.Cantidad','tem.Subtotal','tem.Igv','pr.Nombre_Productos','tem.id_Tem_Carito','tem.id_Proveedor','tem.id_Persona')->get();
        }else{
            return $query=DB::table('temcarrito as tem')
                ->join('persona as per','tem.id_Persona','=','per.id_Persona')
                ->join('productos as pr','tem.id_Producto','=','pr.idProductos')
                ->where('tem.id_Persona','=',$idcliente)
                ->where('tem.usuario_id_usuario','=',$idvendedor)
                ->select([DB::raw("CONCAT(per.nombre_per,' ',per.apellidos_per) as nombres"),'tem.Precio_Venta','tem.Cantidad','tem.Subtotal','tem.Igv','pr.Nombre_Productos','tem.id_Tem_Carito','tem.id_Persona','tem.id_Proveedor'])->get();
        }
    }
    public function obtenertotal($idvendedor,$idcliente,$idproveedor){
        if ($idcliente==null || $idcliente=='undefined'){
            return DB::select("SELECT sum(temcarrito.Subtotal) as total from  temcarrito WHERE   temcarrito.id_Proveedor=$idproveedor and temcarrito.usuario_id_usuario=$idvendedor");
        }else{
            return DB::select("SELECT sum(temcarrito.Subtotal) as total from  temcarrito WHERE  temcarrito.id_Persona=$idcliente and temcarrito.usuario_id_usuario=$idvendedor");
        }
    }
    public function updatecantidad($data){
        $cantidad=$data->cantidad;
        $idcarrito=$data->idtem;
        $Iduser=$data->idvendedor;
        $idproveedor=$data->idproveechangecan;
        $idcliente=$data->idclienchangecan;
        if ($idcliente==''){
            $hola=  DB::select("call UpdateCantidad(?,?,?,?)",array($cantidad,$idcarrito,$Iduser,0));
        }else{
            $hola=  DB::select("call UpdateCantidad(?,?,?,?)",array($cantidad,$idcarrito,$Iduser,1));
        }
       return $result = collect($hola);
    }
    Public function ElimianrCarrito($data)
    {
        if ($data->id==''){
            return 'registro no encontrado';
        }else{
            $id= $data->id;
            $iduser=$data->iduser;
            $idpersona=$data->idpersona;
            $idproveedor=$data->idproveedor;
            if ($idpersona==''){
                DB::table('temcarrito')->where('id_Tem_Carito','=',$id)
                    ->where('usuario_id_usuario','=',$iduser)
                    ->where('id_Proveedor','=',$idproveedor)
                     ->delete();
                return  DB::select("call GetCarrito(?,?,?)",array($iduser,$idproveedor,0));
            }else{
                DB::table('temcarrito')->where('id_Tem_Carito','=',$id)
                    ->where('usuario_id_usuario','=',$iduser)
                    ->where('id_Persona','=',$idpersona)
                    ->delete();
                return  DB::select("call GetCarrito(?,?,?)",array($iduser,$idpersona,1));
            }


        }
    }
    public function obtenercantidadcomprobante($data){
        $idcom =$data->idcompro;
        if ($idcom !=''){
            return TipoComprobante::where('id','=',$idcom)->where('type_movimiento','=',1)->select('cantidad','serie','id')->get();
        }else{
            return 'no existe id comprobante';
        }
    }
    public function Venta($data){
        $idcliente=$data->idcliente;
        $idvendedor=$data->idusuario;
        $montoefectivo=$data->monto_efectivo;
        $vuelto=$data->vuelto;
        $tipo_pago=$data->tipo_pago;
        $comprobante=$data->comprobante;
        $num_venta=$data->num_venta;
        $var_Serie=$data->serie;
        DB::select("call proc_venta(?,?,?,?,?,?,?,?)",array($idcliente,$idvendedor,$montoefectivo,$vuelto,$tipo_pago,$comprobante,$num_venta,$var_Serie));
        $data=['success'=>true];
        return $data;
        if ($venta==true){
            return  $data['succes']=true;
        }else{
            return $data=['error'=>true];
        }

    }
    public function validardni($data)
    {
        $dni=$data->dni;
        return Persona::where('dni_per','=',$dni)->get();
    }
    public function crearnewcliente($data)
    {
        $newDate = date("y/m/d", strtotime($data->fecha_nacimi));
        $apellidos=$data->paterno.' '.$data->materno;
        $user = Persona::create([
            'nombre_per' => $data->nombres,
            'apellidos_per' =>$apellidos,
            'dni_per' => $data->dni,
            'Fecha_Nacimiento' =>$newDate,
            'telefono_per' => null,
            'gmail' => $data->nul,
        ]);
       $tipeper= TipoPersona::create([
            'id_Empresas'=>null,
            'type_Nombre'=>2,
            'id_Persona_del_sistema'=>null,
            'id_Persona_nuevo'=>$user->id_Persona
        ]);
        if ($tipeper!=''){
            return $tipeper;
        }else{
            return 'error';
        }
    }

public function validarruc($data)
{
    $ruc=$data->ruc;
    return Empresa::where('Ruc_Empre','=',$ruc)->get();
}
public function crearnewclientexruc($data)
{
   $empresa=Empresa::create([
       'Ruc_Empre'=> $data->ruc,
       'Razon_social_Empre'=> $data->nombre_razon,
       'Provincia_Empre'=> $data->provincia,
       'Departamento_Empre'=> $data->departamento,
       'Direccion_Empre'=> $data->direccion,
       'Id_Usuario'=> null,
       'gmail_Empre'=>null,
       'telefono_Empre'=>null
   ]);
    $tipeper= TipoPersona::create([
        'id_Empresas'=>$empresa->Id_Empresas_Empre,
        'type_Nombre'=>1,
        'id_Persona_del_sistema'=>null,
        'id_Persona_nuevo'=>$empresa->Id_Empresas_Empre,
    ]);
    if ($tipeper!=''){
        return $tipeper;
    }else{
        return 'error';
    }
}
}
