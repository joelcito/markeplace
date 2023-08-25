<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Departamento extends Model
{
    protected $table        = "departamentos";
    public $timestamps      =  false;
    protected $primaryKey   = "idDepartamentos";

    protected $fillable = [
        'idDepartamentos',
        'idPaises',
        'departamento',
        'estado',
        'usuario_creacion'
    ];
}
