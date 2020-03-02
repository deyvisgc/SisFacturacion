<?php

namespace App\Modelos;

use Illuminate\Database\Eloquent\Model;

class TipoComprobante extends Model
{
    protected $table="tipo_comprobante";
    protected $primaryKey="id";
    public $timestamps=false;
    protected $fillable = [
        'nombre','cantidad','igv','serie'
    ];
}
