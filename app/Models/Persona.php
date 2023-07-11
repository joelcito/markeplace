<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Persona extends Model
{
    // use HasFactory;
    protected $table        = "persona";
    public $timestamps      =  false;
    protected $primaryKey   = "idPersona";

    public function tienda()
    {
        return $this->belongsTo('App\Models\tienda', 'usuario_creacion');
    }
}
