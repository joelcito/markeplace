<?php

namespace App\Http\Controllers;

use App\Models\Producto;
use App\Models\Tienda;
use App\Models\Vendedor;
use App\Models\Venta;
use Illuminate\Http\Request;

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
        $tienda_id      =$tienda->idTienda;

        $ventas = Venta::with('producto')->whereIn('idProducto', function ($query)use ($tienda_id) {
            $query->select('idProducto')
                ->from('producto')
                ->where('idTienda', $tienda_id);
        })->get();
        
        return view("vendedor.ajaxListadoPedido")->with(compact('ventas'))->render();
    }

    public function cambiaEstado(Request $request)    {
        if($request->ajax()){
            $venta_id = $request->input('venta');
            $venta = Venta::find($venta_id);
            $venta->estadoproducto = $request->input('estado');
            $venta->save();
            $data['estado'] = 'success';
        }else{
            $data['estado'] = 'error';
        }
        return $data;
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Vendedor  $vendedor
     * @return \Illuminate\Http\Response
     */
    public function edit(Vendedor $vendedor)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Vendedor  $vendedor
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Vendedor $vendedor)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Vendedor  $vendedor
     * @return \Illuminate\Http\Response
     */
    public function destroy(Vendedor $vendedor)
    {
        //
    }
}
