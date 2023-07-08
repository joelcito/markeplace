<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Mail\EnvioCorreo;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;

class CorreoController extends Controller
{

    public function enviarCorreo(Request $request){
        // Validar los datos del formulario de correo
        $request->validate([
            'destinatario' => 'required|email',
            'asunto' => 'required',
            'mensaje' => 'required',
        ]);

        // Obtener los datos del formulario
        $destinatario = $request->input('destinatario');
        $asunto = $request->input('asunto');
        $mensaje = $request->input('mensaje');

        return response()->json([
            'mensaje'       => 'Correo enviado correctamente',
            'destinatario'  => $$destinatario,
            'asunto'        => $$asunto,
            'mensaje'       => $$mensaje
        ]);

        // Enviar el correo electrónico
        Mail::to($destinatario)->send(new EnvioCorreo($asunto, $mensaje));

        // Retornar una respuesta
        return response()->json(['mensaje' => 'Correo enviado correctamente']);

    }
}
