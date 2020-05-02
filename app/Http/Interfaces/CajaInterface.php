<?php


namespace App\Http\Interfaces;


interface CajaInterface
{
    public function aperturarcaja($data);
    public function obtenertotalcaja($id,$data);
    public function cerrarcaja($data);

}
