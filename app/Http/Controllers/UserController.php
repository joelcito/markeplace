<?php

namespace App\Http\Controllers;

use App\Models\Perfil;
use App\Models\Persona;
use App\Models\Tienda;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

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
            $perfil->estado     = 1;

            $roles_enviados = array_map('intval', $request->get('roles_a'));
            if(in_array(3,$roles_enviados)){
                $tienda                     = new Tienda();
                $tienda->correo             = $request->input('usuario');
                $tienda->estado             = 1;
                $tienda->usuario_creacion   = $persona->idPersona;
                $tienda->usuario_update     = $persona->idPersona;
                $tienda->save();
            }
            $perfil->rol = json_encode($roles_enviados);
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
            // $perfil->rol        = $request->input('rol');
            $perfil->save();
            
            $string         = $perfil->rol;
            $cleanedString  = trim($string, "[]"); // Elimina los corchetes al inicio y al final
            $elements       = explode(",", $cleanedString);
            // Convierte los elementos en números enteros
            $roles_actuales = array_map('intval', $elements);
            $roles_enviados = array_map('intval', $request->get('roles_a'));
            if(count($roles_actuales) != count($roles_enviados)){
                if(count($roles_enviados) < count($roles_actuales)){
                    $elementosFaltantes = collect($roles_actuales)->diff($roles_enviados)->all();
                    if(in_array(3,$elementosFaltantes)){
                        $tienda = Tienda::where('usuario_creacion', $persona->idPersona)->first();
                        $tienda->estado = 2;
                        $tienda->save();
                        DB::table('producto as p1')
                            ->join('producto as p2', 'p1.idProducto', '=', 'p2.idProducto')
                            ->where('p2.idTienda', $tienda->idTienda)
                            ->update(['p1.estadoproducto' => 0]);
                    }
                }else{
                    $elementosFaltantes = collect($roles_enviados)->diff($roles_actuales)->all();
                    if(in_array(3,$elementosFaltantes)){
                        $tienda = Tienda::where('usuario_creacion', $persona->idPersona)->first();
                        if(is_null($tienda)){
                            $tienda = new Tienda();
                            $tienda->usuario_creacion = $persona->idPersona;
                        }
                        $tienda->estado = 1;
                        $tienda->save();
                    }
                }
                $perfil->rol = $roles_enviados;
                $perfil->save();
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
