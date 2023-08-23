<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class SubcripcionControler extends Controller
{
    public function subcripcion(Request $request){
        $logeo = app(LoginController::class);
        $logeo->verificaLogueo();
        return view('subcripcion.subscripcion');
    }

    public function nuevoCorreo(){
        $name = "JOEL FLORES";
        $tipo = "tipo";
        $modalidad = "modalidad";
        $qr = "qr";
        $fecha = "fecha";
        $monto = "monto";
        $url = "url";
        return view('mail.nuevoCorreo')->with(compact('name','tipo','modalidad', 'qr','fecha', 'monto', 'url'));
    }
}
