<?php

namespace App\Http\Controllers\admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class AlmacenController extends Controller
{
    public function articulo(){
        return view('admin.almacen.articulo.index');
    }
}
