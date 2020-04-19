<?php


namespace App\Http\Interfaces;


interface VentaInterface
{
    public function buscardni($data);
    public function buscarruc($data);
    public function buscardnicxsistema($data);
    public function validarcajaabierta($data);
    public function addcarrito($data);
    public function Listcarrito($idvendedor,$idcliente,$idproveedor);
    public function obtenertotal($idvendedor,$idcliente,$idproveedor);
    public function updatecantidad($data);
    Public function ElimianrCarrito($data);
    public function obtenercantidadcomprobante($data);
    public function Venta($data);
    public function validardni($data);
    public function crearnewcliente($data);
    public function validarruc($data);
    public function crearnewclientexruc($data);

}
