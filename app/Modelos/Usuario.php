<?php

namespace App\Modelos;

use Illuminate\Database\Eloquent\Model;

class Usuario extends Model
{
    protected $table = 'usuarios';
    protected $primaryKey = 'idusuarios';
    public $timestamps=false;


 protected $fillable = [
 ];

    public  function  persona () {

        return $this->belongsTo(Usuario::class, 'id_Persona', 'idPersona');
    }
}
