<?php

namespace App\Http\Controllers\Movimiento;

use App\Http\Controllers\Controller;
use App\Http\Repositorios\VentaRepository;
use App\Modelos\Persona;
use App\Modelos\Producto;
use App\Modelos\TipoComprobante;
use Barryvdh\DomPDF\Facade as PDF;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;

use Tecactus\Reniec\DNI;
use DB;

use Yajra\DataTables\DataTables;
use Illuminate\Support\Facades\App;

class VentaController extends Controller
{
    /**
     * @var VentaRepository
     */
    private $repository;

    /**
     * VentaController constructor.
     * @param VentaRepository $repository
     */
    public function __construct(VentaRepository $repository)
    {
        $this->repository = $repository;
    }

    public function index(){
        $id_user = Auth::user()->idusuarios;
        $tipocomprobante=TipoComprobante::where('type_movimiento','=',1)->get();
        $caja=DB::table('caja')->select('caj_descripcion','idCaja')
            ->where('usuarios_idusuarios','=',$id_user)->get();
      $cadescr=$caja[0]->caj_descripcion;
      $idcaja=$caja[0]->idCaja;
     return view('admin.Ventas.ventas',['cajadesc'=>$cadescr,'idcaja'=>$idcaja,'tipocomprobante'=>$tipocomprobante]);
 }
 public function store(){
     return response()->json('sdsdsds');
 }
 public function buscardni(Request $request){
     $essalud = new \jossmp\essalud\asegurado();
     $dni = $request->dni;
     $search2 = $essalud->consulta( $dni );
     if($search2->success == true )
     {
         return response()->json($search2->result);
     }
 }
 public function buscarruc(Request $request){
     $ruc = $request->get('ruc');
     return response()->json($this->repository->buscarruc($ruc));
 }
 public function buscardnixsistema(Request $request){
     $provee=$request->texto;
     $query = DB::table('persona')->where('dni_per', 'like',  '%' . $provee . '%')->get();
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
  //   return response()->json($this->repository->buscardnicxsistema($provee));
 }
 public function BuscarProducto(Request $request){
     $producto=$request->texto;
     $query = DB::table('productos as p')
             ->join('imagenes as ima','p.Imagenes_idImagenes','=','ima.idImagenes')
             ->select('p.Nombre_Productos','p.precio_venta','p.precio_compra','p.idProductos','p.precio_venta','ima.ruta_imagen','p.Stock_Productos','p.modelo_producto')
              ->where('p.Nombre_Productos', 'like',  '%' . $producto . '%')
              ->orWhere('p.codigo_Producto', 'like',  '%' . $producto . '%')
              ->orWhere('p.modelo_producto', 'like',  '%' . $producto . '%')
             ->get();

     foreach ($query as $quer)
     {
         $resulta[] = [ 'idproducto' => $quer->idProductos, 'value' =>$quer->Nombre_Productos, 'precio' =>$quer->precio_venta,'precio_compra'=>$quer->precio_compra,'stock'=>$quer->Stock_Productos,'ima'=>$quer->ruta_imagen,'modelo'=>$quer->modelo_producto];
     }
     $data=array('hecho'=>'si','list_cliente'=>$resulta);

     if ($data===false){
         return response()->json('errors.custom', [], 500);
     }else{
         echo json_encode($data);
     }

 }
 public function validarcajaaperurada(Request $request){
        $idvendedor=$request->idvendedor;
     return response()->json($this->repository->validarcajaabierta($idvendedor));

 }
 public function ADDCARRITO(Request $request){
        $compra=$this->repository->addcarrito($request);
     $idpersona=isset($compra[0]->id_Persona);
        if ($idpersona==null){

            $idproveedor=$compra[0]->id_Proveedor;
            $subtotal=$compra[0]->total;
            $igv=round($subtotal*0.18, 3);
            $total=round($subtotal+$igv, 3);
            return response()->json(array('idproveedor'=>$idproveedor,'subtotal'=>$subtotal,'igv'=>$igv,'total'=>$total));
        }else{
            $idper=$compra[0]->id_Persona;
            $subtotal=$compra[0]->total;
            $igv=round($subtotal*0.18, 3);
            $total=round($subtotal+$igv, 3);
            return response()->json(array('id_persona'=>$idper,'subtotal'=>$subtotal,'igv'=>$igv,'total'=>$total));
        }
 }
 public function Listarcarrito(Request $request){
        $idvendedor=$request->idvendedor;
        $idcliente=$request->idpersona;
        $idproveedor=$request->idproveedor;
        $result=$this->repository->Listcarrito($idvendedor,$idcliente,$idproveedor);
     if ($request->ajax()){
         return DataTables::of($result)->make(true);
     }


 }
 public function Obtenertotales(Request $request){
     $idvendedor=$request->idvendedor;
     $idcliente=$request->idpersona;
     $idproveedor=$request->idproveedor;
     $result=$this->repository->obtenertotal($idvendedor,$idcliente,$idproveedor);
     $subtotal=$result[0]->total;
     $igv=round($subtotal*0.18, 3);
     $total=round($subtotal+$igv, 3);
     return response()->json(array('subtotal'=>$subtotal,'igv'=>$igv,'total'=>$total));

 }
 public function UpdateCantidadd(Request $request){
  return response()->json($this->repository->updatecantidad($request));
 }
 public function EliminarCarrito(Request $request){
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
 public function Obtenercantidadcomprobante(Request $request){
     return response()->json($this->repository->obtenercantidadcomprobante($request));

 }
 public function Vender(Request $request){
     return response()->json($this->repository->Venta($request));
 }
 public function validardni(Request $request){
     return response()->json($this->repository->validardni($request));
 }
 public function crearnewcliente(Request $request){
     return response()->json($this->repository->crearnewcliente($request));
 }
 public function validarruc(Request $request){
     return response()->json($this->repository->validarruc($request));
 }
 public function crearnewclientexruc(Request $request){
     return response()->json($this->repository->crearnewclientexruc($request));
 }
 public function descargarcomprobante(Request $request){

      $idvendedor=$request->idvendedor;
        $idcliente=$request->idcliente;
        $idproveedor=$request->idproveedor;
         $data = Persona::find(85);
        $persona=DB::select("call datosclientes(?,?,?)",array($idvendedor,$idcliente,$idproveedor));
        $productos=DB::select("call comprobante(?,?,?)",array($idvendedor,$idcliente,$idproveedor));
     //  $productos=Producto::all();
        $fecha_emicion=Carbon::now('America/Lima');
        $fecha = explode(" ", $fecha_emicion);
        $fecha1=$fecha[0];
         $fecha2=$fecha[1];
         $fec=$fecha1.'.'.$fecha2;

         $pdf = App::make('dompdf.wrapper');
         $pdf->loadView('Factura',array('productos'=>$productos,'fecha'=>$fecha_emicion));
         $pdf->setPaper('A4');
   /*  $path = public_path('pdf/');
     $fileName =  $data['nombre_per'] .'.'. str_random(25) .'.' . 'pdf'  ;
     $pdf->save($path . '/' . $fileName);
     return $pdf->download($fileName);
*/
     $path = base_path('storage/app/public/PDF_Ventas');
     $pdfPath = $path.'/'.$data['nombre_per'] .'.'. str_random(25) .'.' . 'pdf';
     $pdf->save($pdfPath);
    // $url = base64_decode($pdfPath);
     return $pdf->download($pdfPath);
    // $img_url = 'http://127.0.0.1:8000/storage/app/public/PDF_Ventas'.''.$nombre;
    // return $img_url;

     // Guardar el pdf generado en aws amazon
    // Storage::disk('local')->put('PDF_Ventas/'.$data['nombre_per'] .'.'. str_random(25) .'.' . 'pdf', file_get_contents($pdfPath),'public');
/*
     $public_path = public_path();
     $fileName =  $data['nombre_per'] .'.'. str_random(25) .'.' . 'pdf'  ;
     $url = $public_path.'/storage/'.$fileName;
     $pdf->save($url);
*/
     //verificamos si el archivo existe y lo retornamos
    // if (Storage::exists($archivo))
  //  {

   //  }
     //si no se encuentra lanzamos un error 404.
  //   abort(404);

 }
    public  function descargar($nombre){

    }
}
