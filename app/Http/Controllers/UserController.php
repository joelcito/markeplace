<?php

namespace App\Http\Controllers;

use App\Models\Perfil;
use App\Models\Persona;
use Illuminate\Http\Request;

class UserController extends Controller
{
    public function listado(Request $request){
        $perfiles = Perfil::all();
        return view('user.listado')->with(compact('perfiles'));
    }

    public function guarda(Request $request){

        // dd($request->all());
        $persona = new Persona();

        $persona->nombres               = $request->input('nombre');
        $persona->apellido_paterno      = $request->input('ap_paterno');
        $persona->apellido_materno      = $request->input('pa_maternmo');
        $persona->ci                    = $request->input('cedula');
        $persona->correo                = $request->input('usuario');
        $persona->estado                = 1;

        $persona->save();

        $perfil = new Perfil();

        $perfil->idPersona  = $persona->idPersona;
        $perfil->usuario    = $request->input('usuario');
        $perfil->contrasena = $request->input('pass');
        $perfil->rol        = $request->input('rol');

        $perfil->save();

        return redirect('users');

    }


}
