<?php


namespace App\Http\Interfaces;


interface IngresoInterface
{
public function addcarrito($data);
public function UpdateCantidad($id);
Public function ElimianrCarrito($data);
public function Pagar($data);
public function getcantidadcomprobante($data);
}
