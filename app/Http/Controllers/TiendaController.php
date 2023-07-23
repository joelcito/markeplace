<?php

namespace App\Http\Controllers;

use App\Mail\EnviarCorreoSuscripcion;
use App\Models\Informacion;
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
        $categorias = Tienda::all();
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

            // dd($request->all());

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

            $data['detalle'] = view('tienda.detallePerfil')->with(compact('tienda'))->render();
            $data['estado'] = 'success';
        }else{
            $data['estado'] = 'error';
        }

        return $data;
    }

    public function elimina(Request $request){
        if($request->ajax()){
            $categoria = $request->input('id');
            Tienda::destroy($categoria);
            $data['estado'] = 'success';
        }else{
            $data['estado'] = 'error';
        }

        return $data;
    }

    public function perfil(Request $request){
        $persona_id = session('perfil')->idPersona;
        $tienda = Tienda::where('usuario_creacion', $persona_id)->first();
        return view('vendedor.perfil')->with(compact('tienda'));
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
            $nombre = $persona->nombre." ".$persona->apellido_paterno." ".$persona->apellido_materno;

            $tienda = Tienda::where('usuario_creacion', $persona->idPersona)->first();
            $email = $tienda->correo;

            $tipo       = $request->input('tipo');
            $modalidad  = $request->input('modalidad');

            $qr = Informacion::find(14);
            $qrImg = $qr->descripcion;



            $para = "jjjoelcito123@gmail.com";
            $asunto = "Correo de prueba";

            // Cuerpo del correo
            $mensaje = "Este es un correo de prueba enviado desde PHP.";

            // Cabeceras del correo
            $headers = "From: suscripcion@comercio-latino.com" . "\r\n" .
                    "Reply-To: suscripcion@comercio-latino.com" . "\r\n" .
                    "X-Mailer: PHP/" . phpversion();

            // Enviar el correo
            if (mail($para, $asunto, $mensaje, $headers)) {
                echo "Correo enviado correctamente.";
            } else {
                echo "Error al enviar el correo.";
            }




            // try {
            //     // Mail::to($email)->send(new EnviarCorreoSuscripcion($nombre, $tipo, $modalidad, $qrImg));
            //     Mail::to("jjjoelcito123@gmail.com")->send(new EnviarCorreoSuscripcion($nombre, $tipo, $modalidad, $qrImg));
            //     echo "¡Correo enviado con éxito!"." "."jjjoelcito123@gmail.com";
            // } catch (\Exception $e) {

            //     // Ocurrió un error al enviar el correo, puedes manejar el error aquí.
            //     echo "Error al enviar el correo: " . $e->getMessage();
            // }
        }
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
}
