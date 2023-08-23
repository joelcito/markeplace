<?php

namespace App\Http\Controllers;

use App\Models\Perfil;
use App\Models\Persona;
use App\Models\Tienda;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class UserController extends Controller
{
    public function listado(Request $request){
        $logeo = app(LoginController::class);
        $logeo->verificaLogueo();
        // $perfiles = Perfil::all();
        // $perfiles = Perfil::where('estado', 1)->orderBy('idPerfil', 'desc')->get();
        $perfiles = Perfil::whereNot('estado', 0)->orderBy('idPerfil', 'desc')->get();
        return view('user.listado')->with(compact('perfiles'));
    }

    public function guarda(Request $request){

        $logeo = app(LoginController::class);
        $logeo->verificaLogueo();

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
            // $perfil->rol        = $request->input('rol');

            $perfil->save();

            // if($perfil->rol === "3"){
            //     $tienda                     = new Tienda();
            //     $tienda->correo             = $request->input('usuario');
            //     $tienda->ubicacion          = "";
            //     $tienda->url_facebook       = "";
            //     $tienda->url_instagram      = "";
            //     $tienda->url_whatsapp       = "";
            //     $tienda->url_correo         = "";
            //     $tienda->estado             = 1;
            //     $tienda->calificacion       = 0;
            //     $tienda->usuario_creacion   = $persona->idPersona;
            //     $tienda->usuario_update     = $persona->idPersona;
            //     $tienda->save();
            // }



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
            // $perfil->rol        = $request->input('rol');
            $perfil->save();

            $string = $perfil->rol;
            $cleanedString = trim($string, "[]"); // Elimina los corchetes al inicio y al final
            $elements = explode(",", $cleanedString);
            // Convierte los elementos en números enteros
            $array = array_map('intval', $elements);

            // dd($array, $request->get('roles_a'));
            $roles_enviados = $request->get('roles_a');
            foreach($roles_enviados as $re){
                if(!in_array((int)$re,$array)){
                    dd($re,$array);
                    $array[] = (int) $re;

                    if($re == 3){

                    }
                }else{
                    // dd($array);
                }
            }

            dd($array);

            if($request->has('roles_a')){
                dd("si", $request->get('roles_a'), $request->input('roles_a'));
            }else{
                dd("no");
            }

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

    public function cambiarEstadoPerfil(Request $request){
        if($request->ajax()){
            $id = $request->input('id');

            $perfil = Perfil::find($id);
            $perfil->estado = $request->input('estado');
            $perfil->save();

            $data['estado'] = 'success';
        }else{
            $data['estado'] = 'error';
        }
        return $data;
    }



}
