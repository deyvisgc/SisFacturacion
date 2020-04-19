<?php

namespace App\Modelos;

use Illuminate\Database\Eloquent\Model;


class detallecaja extends Model
{
    protected $table = 'detallecaja';
    protected $primaryKey = 'id_Detallecaja';
    public $timestamps=false;
    protected $fillable = [
      'Monto_Caja_final','Monto_Caja_apertura','Caja_abierta','id_Caja','fecha_apertura'
    ];
}
