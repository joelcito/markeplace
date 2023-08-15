<?php

namespace App\Http\Controllers;

use App\Models\Perfil;
use App\Models\Producto;
use App\Models\Venta;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

// use Illuminate\Support\Facades\Request;

class HomeController extends Controller
{

    public function index(Request $request){
        $logeo = app(LoginController::class);
        $logeo->verificaLogueo();

        // PRODUCTOS MAS VENDIDOS
        // $prodyctosTienda = Producto::all();
        $prodyctosTienda = Producto::select('nombre')->where('idTienda', 1)->get();
        // $prodyctosTienda = Producto::select('nombre')->where('idTienda', 1)->toSql();

        $productos = $prodyctosTienda->pluck('nombre')->toArray();
        $cantaProduct = Producto::count();
        $numerosAleatorios = [];
        for ($i = 0; $i < $cantaProduct; $i++)
            $numerosAleatorios[] = rand(0,200);
        arsort($numerosAleatorios);
        $numerosAleatorios = array_values($numerosAleatorios);

        //CANTIDAD DE VENDEDORES Y COMPRADORES
        $vendedor       = [];
        $compradores    = [];
        $cantidaVentas  = [];
        $anio = date('Y');
        for ($i=1; $i <= 12; $i++) {
            $numberOfDays = cal_days_in_month(CAL_GREGORIAN, $i, $anio); // Obtener el número de días en el mes especificado
            $mes = (($i<10)? '0'.$i : $i);
            $fechaFin = $anio."-".(($i<10)? '0'.$i : $i)."-".$numberOfDays;

            $vendedores = Perfil::where('rol', 'LIKE', '%3%')
                            ->whereBetween('fecha_creacion', [$anio."-".$mes."-01", $fechaFin])
                            ->count();


            $comprador = Perfil::where('rol', 'LIKE', '%2%')
                                    ->whereBetween('fecha_creacion', [$anio."-".$mes."-01", $fechaFin])
                                    ->count();

            $vendedor[] = $vendedores;
            $compradores[] = $comprador;

            // CANTIDAD DE VENTAS
            $ven = Venta::where('estadoproducto', 3)
                        ->whereBetween('fecha_creacion', [$anio."-".$mes."-01", $fechaFin])
                        ->sum('preciounitario');

            $cantidaVentas[]   = $ven;

        }

        // CANTIDADES DE SUBCRIPCION
        $dato = Perfil::rightJoin(DB::raw('(SELECT 1 AS plandepago UNION SELECT 2 AS plandepago UNION SELECT 3 AS plandepago) AS p'), 'perfil.plandepago', '=', 'p.plandepago')
                        ->select('p.plandepago', DB::raw('COALESCE(COUNT(perfil.plandepago), 0) AS cantidad'))
                        ->groupBy('p.plandepago')
                        ->get()->pluck('cantidad')->toArray();


        // cantidad de productos por tienda
        $tiendas = DB::table('tienda as t')
                    ->leftJoin('perfil as p', function ($join) {
                        $join->on('p.idPersona', '=', 't.usuario_creacion')
                            ->where('p.rol', '=', 3)
                            ->where('p.estado', '=', 1);
                    })
                    ->leftJoin('producto as pro', function ($join) {
                        $join->on('pro.idTienda', '=', 't.idTienda')
                            ->where('pro.estado', '=', 1);
                    })
                    ->where('t.estado', '=', 1)
                    ->groupBy('t.idTienda', 't.nombre')
                    ->orderByDesc('cantidad_productos')
                    ->select('t.idTienda', 't.nombre', DB::raw('COUNT(pro.idTienda) as cantidad_productos'))
                    ->get();

        $nomTiendas = $tiendas->pluck('nombre')->toArray();
        $CantTiendas = $tiendas->pluck('cantidad_productos')->toArray();

        return view('home.inicio')->with(compact('productos', 'numerosAleatorios', 'vendedor', 'compradores','dato', 'cantidaVentas', 'nomTiendas', 'CantTiendas'));
    }
}
