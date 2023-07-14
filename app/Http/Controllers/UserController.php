<?php

namespace App\Http\Controllers;

use App\Models\Perfil;
use App\Models\Persona;
use Illuminate\Http\Request;

class UserController extends Controller
{
    public function listado(Request $request){
        $logeo = app(LoginController::class);
        $logeo->verificaLogueo();
        // $perfiles = Perfil::all();
        $perfiles = Perfil::where('estado', 1)->orderBy('idPerfil', 'desc')->get();
        return view('user.listado')->with(compact('perfiles'));
    }

    public function guarda(Request $request){

        $persona_id = $request->input('persona_id');
        if($persona_id === "0"){
            $persona = new Persona();

            $persona->nombres               = $request->input('nombre');
            $persona->apellido_paterno      = $request->input('ap_paterno');
            $persona->apellido_materno      = $request->input('pa_maternmo');
            $persona->ci                    = $request->input('cedula');
            $persona->correo                = $request->input('usuario');
            $persona->estado                = 1;

            $persona->save();

            $perfil =  new Perfil();

            $perfil->idPersona  = $persona->idPersona;
            $perfil->usuario    = $request->input('usuario');
            $perfil->contrasena = $request->input('pass');
            $perfil->rol        = $request->input('rol');

            $perfil->save();

        }else{
            $persona = Persona::find($persona_id);
            $perfil = Perfil::where('idPersona', $persona_id)->first();

            $persona->nombres               = $request->input('nombre');
            $persona->apellido_paterno      = $request->input('ap_paterno');
            $persona->apellido_materno      = $request->input('pa_maternmo');
            $persona->ci                    = $request->input('cedula');
            $persona->correo                = $request->input('usuario');
            $persona->estado                = 1;

            $persona->save();

            $perfil->usuario    = $request->input('usuario');
            if($request->input('pass') != null){
                $perfil->contrasena = $request->input('pass');
            }
            $perfil->rol        = $request->input('rol');
            $perfil->save();

        }
        return redirect('users');
    }

    public function eliminar(Request $request){
        if($request->ajax()){
            $idPersona = $request->input('id');

            $persona = Persona::find($idPersona);
            $persona->estado = 0 ;
            $persona->save();

            $perfil = Perfil::where('idPersona', $persona->idPersona)->first();
            $perfil->estado = 0;
            $perfil->save();

            $data['estado'] = 'success';
        }else{
            $data['estado'] = 'error';
        }

        return $data;
    }


}
