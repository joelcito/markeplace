<?php

namespace App\Http\Controllers;

use App\Models\Producto;
use Illuminate\Http\Request;

class HomeController extends Controller
{
    public function index(Request $request){

        // dd("habner");

        // PRODUCTOS MAS VENDIDOS
        // $prodyctosTienda = Producto::all();
        $prodyctosTienda = Producto::select('nombre')->where('idTienda', 1)->get();
        // $prodyctosTienda = Producto::select('nombre')->where('idTienda', 1)->toSql();

        // dd($prodyctosTienda);

        $productos = $prodyctosTienda->pluck('nombre')->toArray();
        $cantaProduct = Producto::count();
        $numerosAleatorios = [];
        for ($i = 0; $i < $cantaProduct; $i++)
            $numerosAleatorios[] = rand(0,200);
        arsort($numerosAleatorios);
        $numerosAleatorios = array_values($numerosAleatorios);

        //CANTIDAD DE VENDEDORES Y COMPRADORES





        return view('home.inicio')->with(compact('productos', 'numerosAleatorios'));
    }
}
