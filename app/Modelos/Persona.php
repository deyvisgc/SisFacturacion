<?php

namespace App\Modelos;

use Illuminate\Database\Eloquent\Model;

class Persona extends Model
{
    protected $table = 'persona';
    protected $primaryKey = 'id_Persona';
    public $timestamps=false;

    public  function  user() {
        return $this->hasOne(Persona::class, 'idPersona', 'idPersona');
    }
}



