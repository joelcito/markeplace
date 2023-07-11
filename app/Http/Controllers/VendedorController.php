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
    public function index(Request $request)
    {
        // PRODUCTOS MAS VENDIDOS
        $prodyctosTienda = Producto::select('nombre')->where('idTienda', 1)->get();
        $productos = $prodyctosTienda->pluck('nombre')->toArray();
        $cantaProduct = Producto::count();
        $numerosAleatorios = [];
        for ($i = 0; $i < $cantaProduct; $i++)
            $numerosAleatorios[] = rand(0,200);
        arsort($numerosAleatorios);
        $numerosAleatorios = array_values($numerosAleatorios);

        //PEDIDOS POR MES


        return view('home.inicioVendedor')->with(compact('productos', 'numerosAleatorios'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function pedido(Request $request){

        // $ventas = Venta::all();

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

        // dd(session('perfil')->idPersona);
        // $persona_id = session('perfil')->idPersona;
        // $tienda = Tienda::where('usuario_creacion', $persona_id)->first();
        // $productos = Producto::where('idTienda',$tienda->idTienda)->get();
        // dd($tienda, $productos);

        $ventas = Venta::orderBy('idVenta', 'desc')->get();
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
