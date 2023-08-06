<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Suscripcion extends Model
{
    // use HasFactory;
    protected $table        = "suscripcion";
    public $timestamps      = false;
    protected $primaryKey   = "idSuscripcion";

    protected $fillable = [
        'idSuscripcion',
        'idPerfil',
        'plan',
        'monto',
        'descripcion',
        'fecha_inicio',
        'fecha_final',
        'tipo_fecha',
        'estado',
        'usuario_creacion',
        'fecha_creacion',
        'usuario_update',
        'fecha_update'
    ];
}
