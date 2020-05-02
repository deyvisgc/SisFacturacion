<?php


namespace App\Http\Repositorios;


use App\Http\Interfaces\CajaInterface;
use App\Modelos\Caja;
use App\Modelos\Categoria;
use App\Imagen;
use App\Modelos\detallecaja;
use App\Modelos\Producto;
use App\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;
class AlmacenRepository implements CajaInterface
{
    /******** CATEGORIA ********************/
    public static function insertar($data){
            $obj=new Categoria();
            $obj->Nombre_Categoria=$data->Nombre_Categoria;
            $obj->Estado_categoria=0;
        $data = $obj->save();
        return $data;
    }
    public static function listCliente(){
        $data=Categoria::all();
        return $data;
    }
    public static function listCategoriaActivo(){
        $data=Categoria::where('Estado_categoria',0)->get();
        return $data;
    }
    public static function getCategoria($id){
        $data=Categoria::where('idcategoria',$id)->get();
        return $data[0];
    }
    public static function updateCategoria($data,$id){
        $up= Categoria::find($id);
        $up->Nombre_Categoria=$data->get('Nombre_Categoria');
        $up->Estado_categoria=0;
        $up->update();
        return $up;
    }
    public static function EliminarCategoria($id){
        $del=Categoria::destroy($id);
        return $del;
    }
    public static function estadoInactivo($id){
        $model=Categoria::where('idcategoria',$id)->first();
        $model->Estado_categoria=1;
        $model->update();
        return $model;
    }
    public static function estadoActivo($id){
        $model=Categoria::where('idcategoria',$id)->first();
        $model->Estado_categoria=0;
        $model->update();
        return $model;
    }
    /************************************************************/

    /***** PRODUCTO *******************/
    public static function insertarproducto($data){
        try {
            DB::beginTransaction();
            $imagen=new Imagen();
            if($imagen->ruta_imagen==null){
                if ($data->hasFile('foto')) {
                    $file = $data->file('foto');
                    $file->move(public_path() . '/Imagenes/Productos/', $file->getClientOriginalName());
                    $imagen->ruta_imagen =  $file->getClientOriginalName();
                }
            } else{
                $imagen->ruta_imagen='dora.jpg';
            }
            $imagen->save();
            $producto=new Producto();
            $producto->Nombre_Productos=$data->get('nombre');
            $producto->categoria_idcategoria=$data->get('categoria');
            $producto->Stock_Productos=$data->get('stock');
            $producto->descripcion_Productos=$data->get('descripcion');
            $producto->modelo_producto=$data->get('modelo');
            $producto->Imagenes_idImagenes= $imagen->idImagenes;
            $producto->Estado_Producto=0;
            $producto->precio_venta=$data->get('precioventa');
            $producto->precio_compra=$data->get('preciocompra');
            $producto->codigo_Producto=$data->codigo;
            $producto->save();
            DB::commit();
        } catch (Exception $e) {
            DB::rollback();
        }
        return response()->json('succes');
    }
    public static function listproducto(){
        return DB::table('productos as p')
            ->join('imagenes as i','i.idImagenes','=','p.Imagenes_idImagenes')
            ->join('categoria as c','c.idcategoria','=','p.categoria_idcategoria')
            ->select(
                'p.idProductos',
                'p.Nombre_Productos',
                'p.precio_venta',
                'p.precio_compra',
                'p.descripcion_Productos',
                'c.Nombre_Categoria',
                'i.ruta_imagen',
                'p.Stock_Productos',
                'p.Estado_Producto','p.modelo_producto','p.codigo_Producto'
            )
            ->get();

    }
    public static function getproducto($id){
        $data=DB::table("productos as p")
            ->join("categoria as c","c.idcategoria","=","p.categoria_idcategoria")
            ->join("imagenes as i","i.idImagenes","=","p.Imagenes_idImagenes")
            ->select("p.idProductos",
                "p.Nombre_Productos",
                "p.descripcion_Productos",
                "c.Nombre_Categoria as categoria",
                "i.ruta_imagen as imagen",
                "p.Stock_Productos",
                "p.Estado_Producto",
                "p.modelo_producto",
                "p.codigo_Producto",
                "p.precio_compra",
                "p.precio_venta")->get();
        return $data[0];
    }
    public static function updateproducto($data,$id){
        $up= Producto::find($id);
        $up->Nombre_Categoria=$data->get('Nombre_Categoria');
        $up->Estado_categoria=0;
        $up->update();
        return $up;
    }
    public static function Eliminarproducto($id){
        $del=Producto::destroy($id);
        return $del;
    }
    public static function estadoInactivoproducto($id){
        $model=Producto::where('idProductos',$id)->first();
        $model->Estado_Producto=1;
        $model->update();
        return $model;
    }
    public static function estadoActivoproducto($id){
        $model=Producto::where('idProductos',$id)->first();
        $model->Estado_Producto=0;
        $model->update();
        return $model;
    }
    /************************************************************/
    /******** CAJA ********************/
    public static function insertarCaja($data){
        $obj=new Caja();
        $obj->caj_descripcion=$data->caj_descripcion;
        $obj->caj_codigo=$data->caj_codigo;
        $obj->caj_abierta=$data->caj_abierta;
        $obj->usuarios_idusuarios=$data->usuarios_idusuarios;
        $obj->Monto_Caja_final=$data->Monto_Caja_final;
        $obj->monto_Caja_Inicial=$data->monto_Caja_Inicial;
        $obj->estado=0;
        $data = $obj->save();
        return $data;
    }
    public static function listCaja(){
        return DB::table('caja as c')
            ->join('usuarios as u','u.idusuarios','=','c.usuarios_idusuarios')
            ->select('u.usuario',
                'u.idusuarios',
                'c.idCaja',
                'c.caj_descripcion',
                'c.caj_codigo',
                'c.caj_abierta',
                'c.estado',
                'c.Monto_Caja_final',
                'c.monto_Caja_Inicial')
            ->get();
    }
    public static function getCaja($id){
        $data=Caja::where('idCaja',$id)->get();
        return $data[0];
    }
    public static function updateCaja($data,$id){
        $up= Caja::find($id);
        $up->caj_descripcion=$data->get('caj_descripcion');
        $up->caj_codigo=$data->get('caj_codigo');
        $up->caj_abierta=$data->get('caj_abierta');
        $up->usuarios_idusuarios=$data->get('usuarios_idusuarios');
        $up->Monto_Caja_final=$data->get('Monto_Caja_final');
        $up->monto_Caja_Inicial=$data->get('monto_Caja_Inicial');
        $up->estado=0;
        $up->update();
        return $up;
    }
    public static function EliminarCaja($id){
        $del=Caja::destroy($id);
        return $del;
    }
    public static function estadoInactivoCaja($id){
        $model=Caja::where('idCaja',$id)->first();
        $model->estado=1;
        $model->update();
        return $model;
    }
    public static function estadoActivoCaja($id){
        $model=Categoria::where('idCaja',$id)->first();
        $model->estado=0;
        $model->update();
        return $model;
    }
    public static function estadoUsuario($estado){
        return User::where('estado_user',$estado)->get();
    }
    /************************************************************/
    public function aperturarcaja($data)
    {
        $fecha_entrega = Carbon::now('America/Lima');
      $caja=  detallecaja::create([
            'Monto_Caja_apertura'=>$data->monto,
            'id_Caja'=>$data->caja,
            'Caja_abierta'=>1,
            'Monto_Caja_final'=>0,
            'fecha_apertura'=>$fecha_entrega
          ]);
      if($caja==true){
          $data=['success'=>true,'caja'=>$caja];
          return $data;
      }else{
          return response()->json('ERROR AL APERTURAR LA CAJA', 500);
      }
    }

    public function obtenertotalcaja($id,$data){
     $date = Carbon::now('America/Lima');
     $date = $date->format('yy-m-d');
     $idcaja=$data->idcaja;
     return DB::table('detallecaja as dtc')
            ->join('caja as c','dtc.id_Caja','=','c.idCaja')
            ->where('c.usuarios_idusuarios','=',$id)
            ->where('dtc.fecha_apertura','=',$date)
            ->where('dtc.id_Caja','=',$idcaja)
            ->where('dtc.Caja_abierta','=',1)
            ->select('Monto_Caja_apertura','dtc.id_Detallecaja')
            ->get();
    }
    public function cerrarcaja($data){
        $fecha_cierre = Carbon::now('America/Lima');
        $id=$data->iddeta;
        $monto=$data->monto;
      $ciere= detallecaja::where('id_Detallecaja','=',$id)->update(['Monto_Caja_final'=>$monto,'Caja_abierta'=>0,'fecha_cierre'=>$fecha_cierre]);
        if($ciere==true){
            $data=['success'=>true];
            return $data;
        }else{
            return response()->json('ERROR AL CERRAR CAJA', 200);
        }
    }
}
