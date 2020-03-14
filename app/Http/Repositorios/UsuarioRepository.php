<?php


namespace App\Http\Repositorios;


use App\Http\Interfaces\UsuarioInterfaces;
use App\Modelos\Persona;
use App\Modelos\Rol;
use App\Modelos\Usuario;
use DB;
use Illuminate\Support\Facades\Input;
use Yajra\Datatables\Datatables;
use Validator;

class UsuarioRepository implements UsuarioInterfaces
{

    /**
     * UsuarioRepository constructor.
     */
    public function __construct(Usuario $usuario,Persona $persona)
    {
        $this->usuario = $usuario;
        $this->persona = $persona;
    }

    public function Store($data)
    {
        try {
            DB::beginTransaction();
            $persona=new $this->persona();
            $persona->nombre_per=$data->get('nombre');
            $persona->apellidos_per=$data->get('apellidos');
            $persona->telefono_per=$data->get('telefono');
            $persona->dni_per=$data->get('dni');
            $persona->gmail=$data->get('correo');
            $persona->Fecha_Nacimiento=$data->get('fecha_naci');
            $persona->save();
            $usuario=new $this->usuario();
            $usuario->usuario=$data->usuario;
            $usuario->Id_Rol=$data->rol;
            $usuario->password= bcrypt($data->clave);
            $usuario->idPersona=$persona->id_Persona;
            $usuario->estado_user=1;
            if($data->file=='undefined'){
                $usuario->user_foto ='default-avatar.jpg';
            }
            else{
                if (Input::hasFile('file')) {
                    $file = Input::file('file');
                    $file->move(public_path() . '/Imagenes/Usuarios/', $file->getClientOriginalName());
                    $usuario->user_foto = $file->getClientOriginalName();
                }
            }
            $usuario->save();
            DB::commit();
        } catch (Exception $e) {
            DB::rollback();
        }
        $data=['succes'=>true];
        return $data;
    }

    public function Actualizar($data)
    {
        try {
            DB::beginTransaction();
            $persona=Persona::find($data->id_persona);
            $persona->nombre_per=$data->get('nombre');
            $persona->apellidos_per=$data->get('apellidos');
            $persona->telefono_per=$data->get('telefono');
            $persona->dni_per=$data->get('dni');
            $persona->gmail=$data->get('correo');
            $persona->Fecha_Nacimiento=$data->get('fecha_naci');
            $persona->save();
            $user=Usuario::find($data->id_user);
            $image_path="Imagenes/Usuarios/$user->user_foto";
            if(\File::exists(Public_path($image_path))){
                \File::delete(Public_path($image_path));
            }
            if (Input::hasFile('files')) {
                $file = Input::file('files');
                $file->move(public_path() . '/Imagenes/Usuarios/', $file->getClientOriginalName());
                $user->user_foto =  $file->getClientOriginalName();
            }
            $user->usuario=$data->usuario;
            $user->Id_Rol=$data->rol;
            $user->save();
            DB::commit();
            $data['succes']=true;
        } catch (Exception $e) {
            DB::rollback();
        }
        return $data;
    }

    public function edit($id)
    {
        $rol=Rol::all();
        $perso= DB::table('usuarios as u')
               ->join('persona as p','u.idPersona','=','p.id_Persona')
                ->select('u.usuario','p.nombre_per','p.apellidos_per','p.telefono_per', 'p.dni_per','p.gmail','p.Fecha_Nacimiento','u.idusuarios','u.user_foto','u.Id_Rol','u.idPersona')
                ->where('u.idPersona','=',$id)
                ->get();
        return array('rol'=>$rol,'perso'=>$perso);
    }

    public function Canbairestado($id)
    {
        // TODO: Implement Canbairestado() method.
    }

    public function listar()
    {
        return DB::SELECT("SELECT u.usuario,r.nombre_rol,concat(p.nombre_per,' ',p.apellidos_per) as nombres, p.telefono_per,p.dni_per,p.gmail,p.Fecha_Nacimiento,u.idPersona,u.user_foto,u.estado_user from usuarios as u,persona as p,rol as r WHERE u.idPersona=p.id_Persona and u.Id_Rol=r.id_rol");
   /*  $profession = Persona::first();
       $profession->user;
       return $profession;
   */

    }
}
