<?php

namespace App\Modelos;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Notifications\Notifiable;
use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Foundation\Auth\User as Authenticatable;

class Caja extends Model
{
    protected $table = 'caja';
    protected $primaryKey = 'idCaja';
    public $timestamps=false;
}
