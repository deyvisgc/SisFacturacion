<?php


namespace App\Http\Interfaces;


interface PermisosInterface
{
public function registrarprivilegio($data);
public function editarPrivilegio($data);
    public function Eliminarprivilegio($data);
    public function getPermisos();
    public function getPrivilegiohijos($data);
    public function RegistrarPermisos(array $data,$idrol,$idpadre);
}
