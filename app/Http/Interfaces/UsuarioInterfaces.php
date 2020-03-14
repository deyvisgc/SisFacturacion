<?php


namespace App\Http\Interfaces;


interface UsuarioInterfaces
{
    public function Store($data);
    public function Actualizar($data);
    public function edit($id);
    public function Canbairestado($id);
    public function listar();

}
