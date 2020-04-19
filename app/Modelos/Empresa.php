<?php

namespace App\Modelos;

use Illuminate\Database\Eloquent\Model;

class Empresa extends Model
{
    protected $table="empresas";
    protected $primaryKey="Id_Empresas_Empre";
    public $timestamps=false;
    protected $fillable = [
        'Ruc_Empre','Razon_social_Empre','Provincia_Empre','Departamento_Empre','Direccion_Empre','Id_Usuario','gmail_Empre','telefono_Empre'
    ];
}
