<?php


namespace App\Http\Repositorios;


use App\Categoria;
use App\Imagen;
use App\Producto;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class AlmacenRepository
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
                    $file->move(public_path() . '/img/producto/', $file->getClientOriginalName());
                    $imagen->ruta_imagen =  $file->getClientOriginalName();
                }
            } else{
                $imagen->ruta_imagen='dora.jpg';
            }
            $imagen->save();
            $producto=new Producto();
            $producto->Nombre_Productos=$data->get('nombre');
            $producto->categoria_idcategoria=$data->get('categoria');
            $producto->Precio_Productos=$data->get('precio');
            $producto->Stock_Productos=$data->get('stock');
            $producto->descripcion_Productos=$data->get('descripcion');
            $producto->modelo_producto=$data->get('modelo');
            $producto->Imagenes_idImagenes= $imagen->idImagenes;
            $producto->Estado_Producto=0;
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
                'p.Precio_Productos',
                'p.descripcion_Productos',
                'c.Nombre_Categoria',
                'i.ruta_imagen',
                'p.Stock_Productos',
                'p.Estado_Producto','p.modelo_producto','p.codigo_Producto'
            )
            ->get();
        
    }
    public static function getproducto($id){
        $data=Categoria::where('idcategoria',$id)->get();
        return $data[0];
    }
    public static function updateproducto($data,$id){
        $up= Categoria::find($id);
        $up->Nombre_Categoria=$data->get('Nombre_Categoria');
        $up->Estado_categoria=0;
        $up->update();
        return $up;
    }
    public static function Eliminarproducto($id){
        $del=Categoria::destroy($id);
        return $del;
    }
    public static function estadoInactivoproducto($id){
        $model=Categoria::where('idcategoria',$id)->first();
        $model->Estado_categoria=1;
        $model->update();
        return $model;
    }
    public static function estadoActivoproducto($id){
        $model=Categoria::where('idcategoria',$id)->first();
        $model->Estado_categoria=0;
        $model->update();
        return $model;
    }
    /************************************************************/
}
