<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Producto extends Model
{
    use HasFactory;
    protected $table        = "producto";
    public $timestamps      = false;
    protected $primaryKey   = "idProducto";

    protected $fillable = [
        'idProducto',
        'idSubcategoria',
        'idTienda',
        'nombre',
        'descripcion',
        'imagenes',
        'preciounitario',
        'moneda',
        'cantidad',
        'descuento',
        'descuento',
        'ubicacion',
        'estado',
        'estadoproducto',
        'archivos',
        'usuario_creacion',
        'usuario_creacion',
        'usuario_update',
        'fecha_update',
    ];

    public function subCategoria()
    {
        return $this->belongsTo('App\Models\subCategoria', 'idSubcategoria');
    }
}
