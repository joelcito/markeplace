<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class SubCategoria extends Model
{
    use HasFactory;
    protected $table        = "subcategoria";
    public $timestamps      = false;
    protected $primaryKey   = "idSubcategoria";

    public function categoria(){
        return $this->belongsTo('App\Models\Categoria', 'idCategoria');
    }
}
