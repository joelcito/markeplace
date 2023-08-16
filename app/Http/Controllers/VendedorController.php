<?php

namespace App\Http\Controllers;

use App\Models\Producto;
use App\Models\Tienda;
use App\Models\Vendedor;
use App\Models\Venta;
use App\Models\Informacion;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;


class VendedorController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request){

        $logeo = app(LoginController::class);
        $logeo->verificaLogueo();

        $persona_id = session('perfil')->idPersona;
        $tienda = Tienda::where('usuario_creacion', $persona_id)->first();
        $tienda_id = $tienda->idTienda;
        // PRODUCTOS MAS VENDIDOS
        $prodyctosTienda    = Producto::select('*')->where('idTienda', $tienda_id)->get();
        $productos          = $prodyctosTienda->pluck('nombre')->toArray();
        $productosId        = $prodyctosTienda->pluck('idProducto')->toArray();
        $numerosAleatorios  = [];
        foreach ($productosId as $key => $value) {
            $cantidad = Venta::where('idProducto', $value)
                                ->where('estadoproducto',3)
                                ->count();

            $numerosAleatorios[] = $cantidad;
        }
        $numerosAleatorios = array_values($numerosAleatorios);

        //PEDIDOS POR MES
        $anio = date('Y');
        $cnatidaMeses  = [];
        for ($i=1; $i <= 12 ; $i++) {
            $numberOfDays = cal_days_in_month(CAL_GREGORIAN, $i, $anio); // Obtener el número de días en el mes especificado
            $mes = (($i<10)? '0'.$i : $i);
            $fechaFin = $anio."-".(($i<10)? '0'.$i : $i)."-".$numberOfDays;
            $cantidad = Venta::whereIn('idProducto', function ($query) use ($tienda_id) {
                $query->select('idProducto')
                    ->from('producto')
                    ->where('idTienda', $tienda_id);
            })->whereBetween('fecha_creacion', [$anio."-".$mes."-01", $fechaFin])
            ->count();
            $cnatidaMeses[] = $cantidad;
        }
        $cnatidaMeses = array_values($cnatidaMeses);


        return view('home.inicioVendedor')->with(compact('productos', 'numerosAleatorios', 'cnatidaMeses'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function pedido(Request $request){

        // $ventas = Venta::all();

        $logeo = app(LoginController::class);
        $logeo->verificaLogueo();

        // return view('vendedor.pedido')->with(compact('ventas'));
        return view('vendedor.pedido');

    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function ajaxListadoPedido(Request $request)
    {
        if($request->ajax()){
            $data['listado'] = $this->listadoArray();
            $data['estado'] = 'success';
        }else{
            $data['estado'] = 'error';
        }
        return $data;

    }

    protected function listadoArray(){

        $persona_id     = session('perfil')->idPersona;
        $tienda         = Tienda::where('usuario_creacion', $persona_id)->first();
        $tienda_id      = $tienda->idTienda;

        // $ventas = Venta::with('producto')->whereIn('idProducto', function ($query)use ($tienda_id) {
        //     $query->select('idProducto')
        //         ->from('producto')
        //         ->where('idTienda', $tienda_id);
        // })->get();
        // })->toSql();

        // $ventas = Venta::whereIn('idProducto', function($query) use ($tienda_id) {
        //     $query->select('idProducto')
        //           ->from('producto')
        //           ->where('idTienda', $tienda_id);
        // })->get();

        $ventas = DB::table('venta')
                    ->select('pedido', DB::raw('sum(preciounitario * cantidad) as total'), 'usuario_creacion', 'estadoproducto')
                    ->whereIn('idProducto', function ($query) use ($tienda_id) {
                        $query->select('idProducto')
                            ->from('producto')
                            ->where('idTienda', $tienda_id);
                    })
                    ->groupBy('pedido', 'usuario_creacion', 'estadoproducto')
                    ->get();
        // })->toSql();

        // ************** PARA COMERCIO LATINO ********************
        $nombre = Informacion::where('codigo','nombre')->first();
        $datosPdf['nombreCL'] = $nombre->descripcion;
        $telefono = Informacion::where('codigo','telefono')->first();
        $datosPdf['telefonoCL'] = $telefono->descripcion;
        $correo = Informacion::where('codigo','correo')->first();
        $datosPdf['correoCL'] = $correo->descripcion;

        // dd($ventas, $tienda_id);

        return view("vendedor.ajaxListadoPedido")->with(compact('ventas', 'datosPdf'))->render();
    }

    public function cambiaEstado(Request $request)    {
        if($request->ajax()){
            $pedido = $request->input('pedido');
            $estado = $request->input('estado');
            Venta::where('pedido', $pedido)
                 ->update(['estadoproducto' => $estado]);
            // $venta_id = $request->input('venta');
            // $venta = Venta::find($venta_id);
            // $venta->estadoproducto = $request->input('estado');
            // $venta->save();
            $data['estado'] = 'success';
        }else{
            $data['estado'] = 'error';
        }
        return $data;
    }

}
