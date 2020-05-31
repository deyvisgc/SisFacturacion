<?php

namespace App\Modelos;

use Illuminate\Database\Eloquent\Model;

class RolPrivilegios extends Model
{
    protected $table="rol_privilegios";
    protected $primaryKey="Id_RolPrivilegios";
    public $timestamps=false;
    protected $fillable = [
        'id_rol','id_Privilegio','id_Privilegio_padre','rol_has_estado'
    ];
}
