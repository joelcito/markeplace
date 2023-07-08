<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Vendedor extends Model
{
    use HasFactory;
    protected $table        = "tienda";
    public $timestamps      = false;
    protected $primaryKey   = "idTienda";
}
