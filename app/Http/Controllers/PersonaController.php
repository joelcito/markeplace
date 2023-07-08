<?php

namespace App\Http\Controllers;

use App\Models\Persona;
use App\Models\Venta;
use Illuminate\Http\Request;

class PersonaController extends Controller
{
    public function perfil(Request $request){
        $persona = Persona::find(1);
        return view('persona.perfil')->with(compact('persona'));
    }

    public function pedido(Request $request){
        $ventas = Venta::all();
        return view('persona.venta')->with(compact('ventas'));
    }
}
