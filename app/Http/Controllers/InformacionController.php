<?php

namespace App\Http\Controllers;

use App\Models\Informacion;
use Illuminate\Http\Request;

class InformacionController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function perfil(Request $request)
    {
        $informacion = Informacion::all();
        return view('informacion.perfil')->with(compact('informacion'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function guarda(Request $request)
    {
        // $informacion                = Informacion::where('codigo',"quienessomos")->first();
        // $informacion                = Informacion::where('codigo',"quienessomos")->toSql();

        // dd($informacion);
        // $informacion->descripcion   = $request->input('quienessomos');
        // $informacion->descripcion   = "JOEL.";
        // $informacion->save();
        // dd($request->input('quienessomos'), $informacion, $informacion->descripcion);
        $informacion = Informacion::where('codigo',"mision")->first();
        $informacion->descripcion = $request->input('mision');
        $informacion->save();
        $informacion = Informacion::where('codigo',"vision")->first();
        $informacion->descripcion = $request->input('vision');
        $informacion->save();
        $informacion = Informacion::where('codigo',"whatsapp")->first();
        $informacion->descripcion = $request->input('whatsapp');
        $informacion->save();
        $informacion = Informacion::where('codigo',"telegram")->first();
        $informacion->descripcion = $request->input('telegram');
        $informacion->save();
        $informacion = Informacion::where('codigo',"facebook")->first();
        $informacion->descripcion = $request->input('facebook');
        $informacion->save();
        $informacion = Informacion::where('codigo',"politicas")->first();
        $informacion->descripcion = $request->input('politicas');
        $informacion->save();
        $informacion = Informacion::where('codigo',"telefono")->first();
        $informacion->descripcion = $request->input('telefono');
        $informacion->save();
        $informacion = Informacion::where('codigo',"correo")->first();
        $informacion->descripcion = $request->input('correo');
        $informacion->save();
        $informacion = Informacion::where('codigo',"qr1")->first();
        $informacion->descripcion = $request->input('qr1');
        $informacion->save();
        $informacion = Informacion::where('codigo',"qr2")->first();
        $informacion->descripcion = $request->input('qr2');
        $informacion->save();
        $informacion = Informacion::where('codigo',"qr3")->first();
        $informacion->descripcion = $request->input('qr3');
        $informacion->save();

        // $informacion    = Informacion::all();
        // $informacion[1]->descripcion = "joel";
        // dd($informacion[1]->descripcion);
        // $informacion[1]->save();
        // dd($informacion);
        // dd($informacion[0]->descripcion);

        return redirect('informacion/perfil');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Informacion  $informacion
     * @return \Illuminate\Http\Response
     */
    public function show(Informacion $informacion)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Informacion  $informacion
     * @return \Illuminate\Http\Response
     */
    public function edit(Informacion $informacion)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Informacion  $informacion
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Informacion $informacion)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Informacion  $informacion
     * @return \Illuminate\Http\Response
     */
    public function destroy(Informacion $informacion)
    {
        //
    }
}
