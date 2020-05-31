<?php


namespace App\Http\Interfaces;


interface CajaInterface
{
    public function aperturarcaja($data);
    public function obtenertotalcaja($id,$data);
    public function cerrarcaja($data);
    public function listarcaja($id);
    public function buscar($fecha_ini,$fecha_fin);

}
