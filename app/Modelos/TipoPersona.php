<?php

namespace App\Modelos;

use Illuminate\Database\Eloquent\Model;

class TipoPersona extends Model
{
    protected $table="tipo_persona";
    protected $primaryKey="id_tipo_persona";
    public $timestamps=false;
    protected $fillable = [
        'id_Empresas','type_Nombre','id_Persona_del_sistema','id_Persona_nuevo'
    ];
}
