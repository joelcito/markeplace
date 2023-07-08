<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Venta extends Model
{
    // use HasFactory;

    protected $table        = "venta";
    public $timestamps      =  false;
    protected $primaryKey   = "idVenta";

    public function producto()
    {
        return $this->belongsTo('App\Models\producto', 'idProducto');
    }
}
