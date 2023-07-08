<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Perfil extends Model
{
    use HasFactory;
    protected $table        = "perfil";
    public $timestamps      = false;
    protected $primaryKey   = "idPerfil";

    public function persona()
    {
        return $this->belongsTo('App\Models\persona', 'idPersona');
    }
}
