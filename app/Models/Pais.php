<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Pais extends Model
{
    protected $table        = "paises";
    public $timestamps      =  false;
    protected $primaryKey   = "idPaises";

    protected $fillable = [
        'idPaises',
        'pais',
        'estado',
        'usuario_creacion'
    ];
}
