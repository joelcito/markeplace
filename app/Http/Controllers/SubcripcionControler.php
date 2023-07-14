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
}
