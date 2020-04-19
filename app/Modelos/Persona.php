<?php

namespace App\Modelos;

use Illuminate\Database\Eloquent\Model;

class Persona extends Model
{
    protected $table = 'persona';
    protected $primaryKey = 'id_Persona';
    public $timestamps=false;

    protected $fillable = [
        'nombre_per','apellidos_per','telefono_per','dni_per','gmail','Fecha_Nacimiento'
    ];
    public  function  user() {
        return $this->hasOne(Persona::class, 'idPersona', 'idPersona');
    }
}



