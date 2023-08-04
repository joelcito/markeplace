<?php

namespace App\Http\Controllers;

use App\Mail\EnviarCorreoSuscripcion;
use App\Models\Informacion;
use App\Models\Perfil;
use App\Models\Persona;
use App\Models\Tienda;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;

class TiendaController extends Controller
{
    public function listado(Request $request){
        $logeo = app(LoginController::class);
        $logeo->verificaLogueo();
        return view('tienda.listado');
    }

    public function ajaxListado(Request $request){
        $data = array();
        if($request->ajax()){
            $data['estado'] = 'success';
            $data['listado'] = $this->listadoArray();
        }else{
            $data['estado'] = 'error';
        }

        return json_encode($data);
    }

    protected function listadoArray(){
        // $categorias = Tienda::all();
        $categorias = Tienda::whereNot('estado',0)->get();
        return view("tienda.ajaxListado")->with(compact('categorias'))->render();
    }

    public function guarda(Request $request){
        if($request->ajax()){
            $tienda_id = $request->input('tienda_id');
            if($tienda_id === "0"){
                $tienda = new Tienda();
            }
            else{
                $tienda = Tienda::where('idTienda',$tienda_id)->first();
            }

            $tienda->nombre         = $request->input('nombre');
            $tienda->nit            = $request->input('nit');
            $tienda->celular        = $request->input('celular');
            $tienda->correo         = $request->input('correo');
            $tienda->descripcion    = $request->input('descripcion');

            $tienda->ubicacion      = $request->input('ubicacion');
            $tienda->url_facebook   = $request->input('url_facebook');
            $tienda->url_instagram  = $request->input('url_instagram');
            $tienda->url_whatsapp   = $request->input('url_whatsapp');
            $tienda->url_correo     = $request->input('correo');

            if($request->file('archivo')){
                $archivos           = $request->file('archivo');
                $archivo            = $archivos;
                $direccion          = 'imgLogoTienda/';
                $nombreArchivo      = date('YmdHis').".".$archivo->getClientOriginalExtension();
                $archivo->move($direccion,$nombreArchivo);
                $tienda->logo    = $nombreArchivo;
            }

            $tienda->save();

            // persona y perfil
            $persona = Persona::find($tienda->usuario_creacion);
            $persona->correo = $request->input('usuario');
            $persona->save();

            $perfil = Perfil::where('idPersona', $persona->idPersona)->first();
            $perfil->usuario = $request->input('usuario');
            if($request->input('contrasena') != null){
                $perfil->contrasena = $request->input('contrasena');
            }
            $perfil->save();

            $data['detalle'] = view('tienda.detallePerfil')->with(compact('tienda'))->render();
            $data['estado'] = 'success';
        }else{
            $data['estado'] = 'error';
        }

        return $data;
    }

    public function elimina(Request $request){
        if($request->ajax()){
            $tienda = $request->input('id');
            $tienda = Tienda::find($tienda);
            $tienda->estado = 0;
            $tienda->save();
            $data['estado'] = 'success';
        }else{
            $data['estado'] = 'error';
        }

        return $data;
    }

    public function perfil(Request $request){
        $persona_id = session('perfil')->idPersona;
        $perfil_id = session('perfil')->idPerfil;
        $tienda = Tienda::where('usuario_creacion', $persona_id)->first();
        $perfil = Perfil::where('idPersona', $perfil_id)->first();

        return view('vendedor.perfil')->with(compact('tienda', 'perfil'));
    }

    public function detallePerfil(Request $request){
        if($request->ajax()){
            $persona_id = session('perfil')->idPersona;
            $tienda = Tienda::where('usuario_creacion', $persona_id)->first();
            $data['estado'] = "success";
            $data['detalle'] = view('tienda.detallePerfil')->with(compact('tienda'))->render();
        }else{

        }

        return $data;
    }

    public function enviarCorreo(Request $request){
        if($request->ajax()){
            $perfil = session('perfil');
            $persona = Persona::find($perfil->idPersona);
            $nombre = $persona->nombres." ".$persona->apellido_paterno." ".$persona->apellido_materno;

            $tienda = Tienda::where('usuario_creacion', $persona->idPersona)->first();
            $email = $tienda->correo;

            $tipo       = $request->input('tipo');
            $modalidad  = $request->input('modalidad');

            $qr = Informacion::find(14);
            $qrImg = $qr->descripcion;


            // CAMBIAMOS EL TIPO DE SUSCRIPCION
            $perfil = Perfil::find($perfil->idPerfil);
            $perfil->plandepago = (($tipo === 'basica')? 1 : (($tipo === 'estandar')? 2 : 3) );
            $perfil->save();

            try {
                Mail::to($email)->send(new EnviarCorreoSuscripcion($nombre, $tipo, $modalidad, $qrImg));
                // Mail::to("jjjoelcito123@gmail.com")->send(new EnviarCorreoSuscripcion($nombre, $tipo, $modalidad, $qrImg));
                $data['estado'] = 'success';
            } catch (\Exception $e) {
                // Ocurrió un error al enviar el correo, puedes manejar el error aquí.
                $data['estado'] = 'error';
            }
        }else{
            $data['estado'] = 'error';
        }

        return $data;
    }

    public function guardaAdmin(Request $request){
        if($request->ajax()){
            $tienda_id = $request->input('tienda_id');

            $tienda = Tienda::find($tienda_id);

            $tienda->nombre         = $request->input('nombre');
            $tienda->nit            = $request->input('nit');
            $tienda->celular        = $request->input('celular');
            $tienda->correo         = $request->input('correo');
            $tienda->descripcion    = $request->input('descripcion');
            $tienda->estado         = $request->input('estado');

            $tienda->save();

            $data['estado'] = 'success';

        }else{
            $data['estado'] = 'error';
        }

        return $data;
    }

    public function cambiaEstadoTienda(Request $request){
        if($request->ajax()){
            // dd($request->all());
            $tienda = Tienda::find($request->input('id'));
            $tienda->estado = $request->input('estado');
            $tienda->save();

            $data['estado'] = "success";
        }else{
            $data['estado'] = "error";
        }
        return $data;
    }
}
