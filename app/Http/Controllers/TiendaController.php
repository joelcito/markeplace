<?php

namespace App\Http\Controllers;

use App\Mail\EnviarCorreoSuscripcion;
use App\Models\Informacion;
use App\Models\Perfil;
use App\Models\Departamento;
use App\Models\Persona;
use App\Models\Pais;
use App\Models\Suscripcion;
use App\Models\Tienda;
use App\Models\Venta;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Mail;

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\SMTP;
use PHPMailer\PHPMailer\Exception;

class TiendaController extends Controller
{

    public $token;

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
            // $tienda->ubicacion      = $request->input('ubicacion');
            // $tienda->ubicacion      = $request->input('pais_perfil')."/".$request->input('ciudades_perfil');
            $pais                   = Pais::find($request->input('pais_perfil'));
            $departamento           = Departamento::find($request->input('ciudades_perfil'));

            $tienda->ubicacion      = $pais->pais."/".$departamento->departamento;
            $tienda->url_facebook   = $request->input('url_facebook');
            $tienda->url_instagram  = $request->input('url_instagram');
            $tienda->url_whatsapp   = $request->input('url_whatsapp');
            $tienda->url_correo     = "mailto:".$request->input('correo');

            if($request->file('archivo')){
                $archivos           = $request->file('archivo');
                $archivo            = $archivos;
                $direccion          = 'imgLogoTienda/';
                $nombreArchivo      = date('YmdHis').".".$archivo->getClientOriginalExtension();
                $archivo->move($direccion,$nombreArchivo);
                $tienda->logo    = $nombreArchivo;
            }

            if($request->file('certificado')){
                $archivos                   = $request->file('certificado');
                $archivo                    = $archivos;
                $direccion                  = 'imgLogoTienda/';
                $nombreArchivo              = date('YmdHis').".".$archivo->getClientOriginalExtension();
                $archivo->move($direccion,$nombreArchivo);
                $tienda->confirmacionnit    = $nombreArchivo;
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

        $logeo = app(LoginController::class);
        $logeo->verificaLogueo();

        $persona_id = session('perfil')->idPersona;
        $perfil_id = session('perfil')->idPerfil;
        $tienda = Tienda::where('usuario_creacion', $persona_id)->first();
        $perfil = Perfil::where('idPersona', $perfil_id)->first();
        $paises = Pais::all();
        $departamentos = Departamento::all();

        if(!is_null($tienda->ubicacion))
            $ubi = explode("/",$tienda->ubicacion);
        else
            $ubi = [];

        if(count($ubi) == 2){
            if($ubi[0] != "" && $ubi[1] != ""){
                $pais           = $ubi[0];
                $departamento   = $ubi[1];
                $paisBus        = Pais::where('pais', $pais)->first();
                $departamentos  = Departamento::where('idPaises', $paisBus->idPaises)->get();
            }else{
                $pais = "";
                $departamento = "";
                $departamentos = [];
            }
        }
        else{
            $pais = "";
            $departamento = "";
            $departamentos = [];
        }

        return view('vendedor.perfil')->with(compact('tienda', 'perfil', 'paises', 'pais', 'departamentos', 'departamento'));
    }

    public function buscarDepartamentos(Request $request){
        if($request->ajax()){

            $pais = $request->input('pais');
            $departamentos = Departamento::where('idPaises', $pais)->get();

            $data['estado']         = 'success';
            $data['departamentos']  = $departamentos;
        }else{
            $data['estado'] = 'error';
        }
        return $data;
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

            // dd($email);

            // ANTIGUO MENSAJE

            $tipo       = $request->input('tipo');
            $modalidad  = $request->input('modalidad');

            // CAMBIAMOS EL TIPO DE SUSCRIPCION
            $perfil = Perfil::find($perfil->idPerfil);
            $perfil->plandepago = (($tipo === 'basica')? 1 : (($tipo === 'estandar')? 2 : 3) );
            $perfil->save();

            $suscripcion = new Suscripcion();
            $suscripcion->idPerfil          = $perfil->idPerfil;
            $suscripcion->plan              = $perfil->plandepago;

            if($tipo === 'basica'){
                $monto = ($modalidad === 'Mensual')? 0 : 0;
            }else if($tipo === 'estandar'){
                $monto = ($modalidad === 'Mensual')? 200 : 2000;
            }else{
                $monto = ($modalidad === 'Mensual')? 500 : 5000;
            }

            $fechaIni = date('Y-m-d H:m:s');
            if($modalidad === 'Mensual'){
                $tipo_fecha = 1;
                $fechaFin = date('Y-m-d H:i:s', strtotime('+1 month', strtotime($fechaIni)));
            }else{
                $tipo_fecha = 2;
                $fechaFin = date('Y-m-d H:i:s', strtotime('+1 year', strtotime($fechaIni)));
            }

            $suscripcion->monto             = $monto;
            $suscripcion->fecha_inicio      = $fechaIni;
            $suscripcion->fecha_final       = $fechaFin;
            $suscripcion->tipo_fecha        = $tipo_fecha;
            $suscripcion->estado            = 1;
            $suscripcion->usuario_creacion  = $perfil->idPerfil;
            $suscripcion->usuario_update    = $perfil->idPerfil;
            $suscripcion->save();


            // $mail = new PHPMailer(true);
            // $mail->AddReplyTo('admin@comercio-latino.com', 'Dennis2');
            // $mail->setFrom('admin@comercio-latino.com', 'Comercio Latino');
            // $mail->addAddress('jjjoelcito123@gmail.com', 'Dennis Echalar');
            // $mail->Subject = 'Asunto del correo electrónico';
            // $mail->msgHTML("<p>prueba canción ññ1</p>");
            // $mail->AltBody = strip_tags("<p>prueba canción ññ2</p>");
            // $mail->CharSet = 'UTF-8';
            // $rta = $mail->send();


            // ESTE ES OTRO CORREO
            $to         = $email;
            $subject    = 'CORREO DE SUSCRIPCION';

            // Cargar el contenido de la vista del correo
            $templatePath = resource_path('views/mail/nuevoCorreo.blade.php');
            $templateContent = file_get_contents($templatePath);
            // ... Configura los datos del correo y la plantilla ...
            if($tipo === "basica"){
                $monto = 0;
            }else if($tipo === "estandar"){
                if($modalidad === "Mensual"){
                    $monto = 200;
                    $qr = Informacion::find(14);
                    $qrImg = $qr->descripcion;
                }
                else{
                    $monto = 2000;
                    $qr = Informacion::find(15);
                    $qrImg = $qr->descripcion;
                }
            }else if($tipo === "superior"){
                if($modalidad === "Mensual"){
                    $monto = 500;
                    $qr = Informacion::find(16);
                    $qrImg = $qr->descripcion;
                }
                else{
                    $monto = 5000;
                    $qr = Informacion::find(17);
                    $qrImg = $qr->descripcion;
                }
            }
            $fecha = date('d/m/Y H:m:s');
            $data = [
                'title'     => 'Bienvenido a mi aplicación',
                'content'   => 'Gracias por unirte a nosotros. Esperamos que disfrutes de tu tiempo aquí.',
                'name'      => $nombre,
                'tipo'      => strtoupper($tipo),
                'modalidad' => strtoupper($modalidad),
                'qr'        => $qrImg,
                'monto'     => $monto,
                'fecha'     => $fecha,
                'url'     => url('vendedor/inicio'),
            ];
            foreach ($data as $key => $value)
                $templateContent = str_replace('{{ $' . $key . ' }}', $value, $templateContent);


            $mail = new PHPMailer(true);

            // Configuración de los parámetros SMTP
            $smtpHost       = 'mail.comercio-latino.com';
            $smtpPort       =  465;
            // $smtpUsername   = 'suscripcion@comercio-latino.com';
            // $smtpPassword   = 'Fc;D&0@A7(T%';
            $smtpUsername   = 'admin@comercio-latino.com';
            $smtpPassword   = '1234567LP1234567LP.';

            // $smtpUsername   = 'sistemas@comercio-latino.com';
            // $smtpPassword   = 'j@xKuZ(65VNK';

            try {
                // $mail->isSMTP();
                // $mail->Host         = $smtpHost;
                // $mail->Port         = $smtpPort;
                // $mail->SMTPAuth     = true;
                // $mail->Username     = $smtpUsername;
                // $mail->Password     = $smtpPassword;
                // $mail->SMTPSecure   = PHPMailer::ENCRYPTION_STARTTLS; no va este
                // $mail->SMTPSecure   = PHPMailer::ENCRYPTION_SMTPS;
                // ... Configura los parámetros SMTP ...
                $mail->setFrom('admin@comercio-latino.com', 'Comercio Latino');
                $mail->addAddress($to);

                // Agregar direcciones de correo electrónico en copia (CC)
                // $mail->addCC('admin@comercio-latino.com', 'Administracion Comercio Latino');
                $mail->addCC('soporte@comercio-latino.com', 'Soporte Comercio Latino');

                $mail->isHTML(true);
                $mail->Subject = $subject;
                $mail->Body    = $templateContent;

                $mail->send();

                // return 'Correo enviado correctamente';
                $data['estado'] = 'success';
                $data['msg']    = 'Correo enviado correctamente';

            } catch (Exception $e) {
                $data['estado'] = 'error';
                $data['msg'] = 'No se pudo enviar el correo: ' . $mail->ErrorInfo;
                // return 'No se pudo enviar el correo: ' . $mail->ErrorInfo;
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

    public function cambiaSuscripcion(Request $request){
        if($request->ajax()){
            // dd($request->all());
            $tienda_id  = $request->input('id');
            $plan       = $request->input('valor');

            $tienda = Tienda::find($tienda_id);
            $perfil = Perfil::where('idPersona',$tienda->usuario_creacion)->first();
            $perfil->plandepago = $plan;
            $perfil->save();



            $suscripcion = new Suscripcion();
            $suscripcion->idPerfil          = $perfil->idPerfil;
            $suscripcion->plan              = $plan;

            // if($plan === '1'){
            //     $monto = ($modalidad === 'Mensual')? 0 : 0;
            // }else if($plan === '2'){
            //     $monto = ($modalidad === 'Mensual')? 200 : 2000;
            // }else{
            //     $monto = ($modalidad === 'Mensual')? 500 : 5000;
            // }

            $fechaIni = date('Y-m-d H:m:s');
            $fechaFin = date('Y-m-d H:m:s');
            // if($modalidad === 'Mensual'){
            //     $tipo_fecha = 1;
            //     $fechaFin = date('Y-m-d H:i:s', strtotime('+1 month', strtotime($fechaIni)));
            // }else{
            //     $tipo_fecha = 2;
            //     $fechaFin = date('Y-m-d H:i:s', strtotime('+1 year', strtotime($fechaIni)));
            // }

            // $suscripcion->monto             = $monto;
            $suscripcion->fecha_inicio      = $fechaIni;
            $suscripcion->fecha_final       = $fechaFin;
            // $suscripcion->tipo_fecha        = $tipo_fecha;
            $suscripcion->estado            = 1;
            $suscripcion->usuario_creacion  = $perfil->idPerfil;
            $suscripcion->usuario_update    = $perfil->idPerfil;
            $suscripcion->save();




            $data['estado'] = 'success';
        }else{
            $data['estado'] = 'error';
        }

        return $data;
    }

    public function cambiaSuscripcionAdmin(Request $request){
        if($request->ajax()){

            $tienda_id  = $request->input('tienda');
            $tipo       = $request->input('tipo');
            $plan       = $request->input('plan');

            $tienda = Tienda::find($tienda_id);

            $persona_id = $tienda->usuario_creacion;

            $perfil                 = Perfil::where('idPersona',$persona_id)->first();
            $perfil->plandepago     = $plan;
            $perfil->save();

            $suscripcion            = new  Suscripcion();
            $suscripcion->idPerfil  = $perfil->idPerfil;
            $suscripcion->plan      = $plan;
            $fechaIni = date('Y-m-d H:m:s');

            if($plan == 2)
                $monto = ($tipo == 1)?  200 : 2000;
            else if($plan == 3)
                $monto = ($tipo == 1)?  500 : 5000;
            else
                $monto = 0;

            if($tipo == 1)
                $fechaFin = date('Y-m-d H:i:s', strtotime('+1 month', strtotime($fechaIni)));
            else
                $fechaFin = date('Y-m-d H:i:s', strtotime('+1 year', strtotime($fechaIni)));

            $suscripcion->monto             = $monto;
            $suscripcion->fecha_inicio      = $fechaIni;
            $suscripcion->fecha_final       = $fechaFin;
            $suscripcion->tipo_fecha        = $tipo;
            $suscripcion->estado            = 1;
            // dd(session('perfil'));
            $suscripcion->usuario_creacion  = session('perfil')->idPersona;
            $suscripcion->save();

            $data['estado'] = 'success';
        }else{
            $data['estado'] = 'error';
        }
        return $data;
    }

    public function verificaPedidos(Request $request){
        if($request->ajax()){
            $persona_id = session('perfil')->idPersona;
            $tienda = Tienda::where('usuario_creacion', $persona_id)->first();
            $tienda_id = $tienda->idTienda;

            $cantidad = Venta::select('pedido', 'estadoproducto')
                            ->whereIn('idProducto', function ($query) use($tienda_id){
                                $query->select('idProducto')
                                    ->from('producto')
                                    ->where('idTienda', $tienda_id)
                                    ->where('estado', 1);
                            })
                            ->where('estadoproducto', 1)
                            ->groupBy('pedido', 'estadoproducto')
                            ->get()->count();

            $data['estado'] = 'success';
            $data['cantidad'] = $cantidad;
        }else{
            $data['estado'] = 'error';
        }
        return $data;
    }
}
