<?php

namespace App;

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
