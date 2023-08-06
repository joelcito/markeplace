<?php

namespace App\Http\Controllers;

use App\Models\Perfil;
use App\Models\Persona;
use App\Models\Venta;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class PersonaController extends Controller
{
    public function perfil(Request $request){
        $logeo = app(LoginController::class);
        $logeo->verificaLogueo();
        $persona_id = session('perfil')->idPersona;
        $persona = Persona::find($persona_id);
        return view('persona.perfil')->with(compact('persona'));
    }

    public function pedido(Request $request){
        // $ventas = Venta::all();
        $perfil_id = session('perfil')->idPerfil;

        $ventas = Venta::
        // $ventas = Venta::select('pedido', 'usuario_creacion',DB::raw('SUM(preciounitario) as total_precio'),'fecha_creacion', 'estadoproducto')
                        // ->where('idPerfil', $perfil_id)
                        where('idPerfil', $perfil_id)
                        // ->groupBy('pedido', 'usuario_creacion','fecha_creacion', 'estadoproducto')
                        ->get();
        //                 ->toSql();
        // dd($ventas, $perfil_id);

        return view('persona.venta')->with(compact('ventas'));
    }

    public function guarda(Request $request){

        $persona_id = $request->input('persona_id');

        $persona = Persona::find($persona_id);

        $persona->nombres           = $request->input('nombres');
        $persona->apellido_paterno  = $request->input('ap_paterno');
        $persona->apellido_materno  = $request->input('ap_materno');
        $persona->ci                = $request->input('cedula');
        $persona->nit               = $request->input('nit');
        $persona->razon_social      = $request->input('razon_social');
        $persona->celular           = $request->input('celular');
        $persona->correo            = $request->input('correo');
        $persona->direccion         = $request->input('direccion');
        $persona->fecha_nacimiento  = $request->input('fecha_nacimiento');

        if($request->hasFile('foto')){
            $archivo = $request->file('foto');
            $nombreOriginal = $archivo->getClientOriginalName();
            $extension = $archivo->getClientOriginalExtension();
            // Generar un nombre de archivo único
            $nombreArchivo = uniqid() . '_' . time() . '.' . $extension;
            $archivo->move(public_path('compradorPerfil'), $nombreArchivo);
            $persona->foto = $nombreArchivo;
        }
        $persona->save();
        $perfil                 = Perfil::find($persona->idPersona);
        $perfil->usuario        = $request->input('correo');
        if($request->filled('password'))
            $perfil->contrasena     = $request->input('password');

        $perfil->save();

        return redirect("persona/perfil");
    }
}
