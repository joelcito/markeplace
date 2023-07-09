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
    public function guarda(Request $request){

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

        if($request->hasFile('qr1')){

            $archivo = $request->file('qr1');
            $nombreArchivo = $archivo->getClientOriginalName();
            $archivo->move(public_path('qrs'), $nombreArchivo);

            $informacion = Informacion::where('codigo',"qr1")->first();
            $informacion->descripcion = $nombreArchivo;
            $informacion->save();
        }

        if($request->hasFile('qr2')){

            $archivo = $request->file('qr2');
            $nombreArchivo = $archivo->getClientOriginalName();
            $archivo->move(public_path('qrs'), $nombreArchivo);

            $informacion = Informacion::where('codigo',"qr2")->first();
            $informacion->descripcion = $nombreArchivo;
            $informacion->save();
        }

        if($request->hasFile('qr3')){

            $archivo = $request->file('qr3');
            $nombreArchivo = $archivo->getClientOriginalName();
            $archivo->move(public_path('qrs'), $nombreArchivo);

            $informacion = Informacion::where('codigo',"qr3")->first();
            $informacion->descripcion = $nombreArchivo;
            $informacion->save();
        }

        if($request->hasFile('logo')){

            $archivo = $request->file('logo');
            $nombreArchivo = $archivo->getClientOriginalName();
            $archivo->move(public_path('qrs'), $nombreArchivo);

            $informacion = Informacion::where('codigo',"logo")->first();
            $informacion->descripcion = $nombreArchivo;
            $informacion->save();
        }

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
